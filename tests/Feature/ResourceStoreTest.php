<?php

namespace Tests\Feature;

use App\Models\Resource;
use App\Models\ResourceType;
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
            ->assertOk()
            ->assertJson([
                'id' => Resource::first()->id,
                'resource_type_id' => ResourceType::first()->id,
                'amount' => 1234,
                'location' => 'Des Moines, Iowa',
            ]);

        $this->assertDatabaseHas('resources', [
            'amount' => 1234,
            'location' => 'Des Moines, Iowa',
            'resource_type_id' => ResourceType::first()->id,
        ]);
    }
}
