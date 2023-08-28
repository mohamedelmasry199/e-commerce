<?php


namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\order_product;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $totalPrice = 0;
        $userId = auth()->user()->id;

        DB::beginTransaction();

        // try {
            $order = Order::create([
                'user_id' =>$userId  ,
                'total_price' => 0, 
            ]);

            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);


                if ($product) {
                    $itemTotalPrice = $product->price * $item['quantity'];
                    $totalPrice += $itemTotalPrice;

                    order_product::create([
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'price' => $itemTotalPrice,
                    ]);
                }
            }

            $order->update(['total_price' => $totalPrice]);

            DB::commit();

            session()->forget('cart');

         return view('success');
} 
        //   catch (\Exception $e) {
        //     // Something went wrong, rollback the transaction
        //     DB::rollback();

        //     return back()->with('error', 'An error occurred while placing the order.');
        // }
    }
