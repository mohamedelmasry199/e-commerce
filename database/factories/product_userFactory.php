<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\product_user;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class product_userFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>User::inRandomOrder()->first,
            'product_id'=>Product::inRandomOrder()->first,
        ];
    }
}
