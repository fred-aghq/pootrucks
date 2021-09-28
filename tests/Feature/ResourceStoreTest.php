<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Util\Test;
use Tests\TestCase;
use Tests\TestConcerns\PostsXML;

class ResourceStoreTest extends TestCase
{
    use PostsXML, RefreshDatabase;
    public function test_it_stores_successfully_with_valid_data()
    {
        $res = $this->json('POST', route('resources.store'), [
            'type' => 'corn',
            'amount' => 1234,
            'location' => 'Des Moines, Iowa',
        ]);

        $res
            ->assertCreated()
            ->assertJson([
                'id' => Product::first()->id,
                'type' => [
                    'id' => ProductType::first()->id,
                    'name' => 'corn',
                ],
                'amount' => 1234,
                'location' => 'Des Moines, Iowa',
            ]);

        $this->assertDatabaseHas('products', [
            'amount' => 1234,
            'location' => 'Des Moines, Iowa',
            'product_type_id' => ProductType::first()->id,
        ]);
    }
}
