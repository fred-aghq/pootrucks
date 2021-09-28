<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::uuid()->toString(),
            'location_id' => Location::factory()->create()->id,
            'product_type_id' => ProductType::factory()->create()->id,
            'amount' => $this->faker->randomFloat(2, 1000, 9999)
        ];
    }
}
