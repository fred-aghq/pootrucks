<?php

namespace Tests\Feature;

use App\Events\ProductAmountAdded;
use App\Events\ProductCreated;
use App\Models\Location;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use PHPUnit\Util\Test;
use Tests\TestCase;
use Tests\TestConcerns\PostsXML;

class ProductStoreTest extends TestCase
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
                'location' => [
                    'id' => Location::first()->id,
                    'name' => 'Des Moines, Iowa',
                ],
            ]);

        $this->assertDatabaseHas('products', [
            'amount' => 1234,
            'location_id' => Location::first()->id,
            'product_type_id' => ProductType::first()->id,
        ]);
    }

    public function test_it_adds_amount_correctly()
    {
        $attributes = Product::factory()->make()->getAttributes();
        $product = Product::create($attributes);
        $originalAmount = $attributes['amount'];
        $product->addAmount(420);
        $this->assertEquals($product->refresh()->amount, $originalAmount + 420);
    }

    public function test_it_subtracts_amount_correctly()
    {
        $attributes = Product::factory()->make()->getAttributes();
        $product = Product::create($attributes);
        $originalAmount = $attributes['amount'];
        $product->subAmount(420);
        $this->assertEquals($product->refresh()->amount, $originalAmount - 420);
    }
}
