<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\order_product;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            $productIds = $products->random(rand(1, 5))->pluck('id')->toArray();

            foreach ($productIds as $productId) {
                order_product::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => rand(1, 10), 
                    'price' => Product::find($productId)->price,
                ]);
            }
        }
    }
}
