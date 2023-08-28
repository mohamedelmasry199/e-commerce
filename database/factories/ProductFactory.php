<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'description'=>fake()->sentence(),
            'product_availability'=>fake()->randomElement(['available', 'not available']),
            'image'=>fake()->image('storage/images/'),
            'price'=>fake()->randomFloat(2,10,100),
            'category_id'=>Category::inRandomOrder()->first()->id,
        ];
    }
}
