<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class order_productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id'=>Order::inRandomOrder()->first(),
            'product_id'=>Product::inRandomOrder()->first(),
            'quantity'=>fake()->numberBetween(0,200),
            'price'=>fake()->randomFloat(2,10,1000),
            
        ];
    }
}
