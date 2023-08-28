<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\product_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index($id) {
        $userProducts = product_user::where('user_id', Auth::user()->id)->get();
        $productIds = $userProducts->pluck('product_id'); 
        
        $products = Product::whereIn('id', $productIds)->get(); 
        
        return view('profile', compact('products'));
    }
    

}
