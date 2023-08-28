<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\product_user;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class Product_userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        foreach ($users as $user) {
            $productIds = $products->random(rand(1, 5))->pluck('id')->toArray();

            foreach ($productIds as $productId) {
                product_user::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                ]);
            }
        }
    }

    }

