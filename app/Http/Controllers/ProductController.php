<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\product_user;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function show($id){
        $product=Product::find($id);
        return view('product.show',compact('product'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->get();

        return view('products', compact('products'));
    }
    public function buy(Request $request, $id = null) {
        $userId = auth()->user()->id;
    
        if ($id !== null) {
            //when the user wants to buy a single product
            $product = Product::find($id);
            
            Order::create([
                'user_id' => $userId,
                'total_price' => $product->price,
            ]);
    
            product_user::create([
                'user_id' => $userId,
                'product_id' => $product->id,
            ]);
    
            return view('buy', compact('product'));
        } else {
            // when the user is buying products from the cart
            $cart = session()->get('cart', []);
            $total = 0;
    
            foreach ($cart as $id => $details) {
                $total += $details['price'] * $details['quantity'];
            }
    
            
    
            return view('cart', compact('total', 'cart'));
        }
    }
    
}
