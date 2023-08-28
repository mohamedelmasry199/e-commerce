<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index(){
        $categories=Category::all();
        return view('home',compact('categories'));
    }
    public function showProducts($category)
    {
        $category = Category::where('name', $category)->firstOrFail();
        $products = $category->products()->whereNull('deleted_at')->get();
        return view('products', compact('category', 'products'));
        
    }
    public function aboutUS(){
        return view('aboutUs');
    }
}
