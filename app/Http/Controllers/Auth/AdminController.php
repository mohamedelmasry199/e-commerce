<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Product;

class AdminController extends Controller
{
    function editPage(){
        return view('edit');
    }
    public function createProduct(){
        return view('product.create');

    }

public function storeProduct(Request $request) {
    $request->validate([
        'name' => 'required|string|min:3|max:25',
        'description' => 'required',
        'image' => 'required|image', // Add image validation rules
        'price' => 'required|numeric',
        'product_availability' => 'required',
        'category_id' => 'required|exists:categories,id',
    ]);
    $imageName=$request->file('image')->getClientOriginalName();
    $imagePath=$request->file('image')->storeAs('/storage/images', $imageName, 'public');
    $request->file('image')->move('storage/images',$imageName);
    $category = Category::find($request->category_id);


    if (!$category) {
        return redirect()->back()->withInput()->withErrors(['category_id' => 'Selected category not found.']);
    }

        Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $imagePath,
        'price' => $request->price,
        'product_availability' => $request->product_availability,
        'category_id' => $category->id,
    ]);
        
    return redirect()->route('category.products', ['category' => $category->name])
        ->with('success', 'Product created successfully.');
}

    public function updateProduct($id){
        $product=Product::find($id);
        return view('product.update',compact('product'));   
     }
    public function editProduct($id , Request $request){
        $product=Product::find($id);
        if ($product) {
            $request->validate([
                'name' => 'required|string|min:3|max:25',
                'description' => 'required',
                'image' => 'image', // Make sure it's an image
                'price' => 'required',
                'product_availability' => 'required',
                'category_id' => 'required|exists:categories,id',
            ]);
            $oldImage=$product->image;
            if ($request->hasFile('image')) {
                // Use the original image name for the updated image
                $imageName = $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('storage/images', $imageName, 'public');
                $request->file('image')->move('storage/images' , $imageName );
            }    
            else{
                $imagePath = $product->image;
            }
            $product->update([
                'name' => $request['name'],
                'description' => $request['description'],
                'image' => $imagePath,
                'price' => $request['price'],
                'product_availability' => $request['product_availability'],
                'category_id' => $request['category_id'],
            ]);
            if(!$oldImage){
                unlink($oldImage);
               }
            return redirect()->route('home');
        }
    }
       
    public function destroyProduct($id){
    $product = Product::find($id);
    $oldImage=$product->image;
    if ($product) {
        $categoryId = $product->category_id;
        $category = Category::where('id', $categoryId)->value('name');
        $product->delete();
        // unlink($oldImage);
        return redirect()->route('category.products',compact('category'));
    }
    else 
    // Handle the case when the product is not found
    return redirect()->back()->with('error', 'Product not found.');
}
    function createCategory(){
    return view('category.create');
}
    function storeCategory(Request $request){
        $request->validate([
            'name'=>'required|string|min:3|max:25',
            'image'=>'required',
        ]);
        $imageName = $request->file('image')->getClientOriginalName();
        $imagePath = $request->file('image')->storeAs('storage/images', $imageName, 'public');
        $request->file('image')->move('storage/images',$imageName);
        Category::create([
            'name'=>$request['name'],
            'image'=>$imagePath,
        ]);
        return redirect()->route('home');
    }
    function updateCategory($id){
        $category=Category::find($id);
        return view('category.update',compact('category'));   
    }
    function editCategory($id , Request $request){
        $category=Category::find($id);

        if ($category) {
            $request->validate([
                'name' => 'required|string|min:3|max:25',
                'image' => 'required|image', // Make sure it's an image
            ]);
             $oldImage=$category->image;
            if ($request->hasFile('image')) {
                // Use the original image name for the updated image
                $imageName = $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('storage/images', $imageName, 'public');
                $request->file('image')->move('storage/images' , $imageName);
            }    
            $category->update([
                'name' => $request['name'],
                'image' => $imagePath,
            ]);
            // unlink($oldImage);
    
            return redirect()->route('home');
        }
    }
    function destroyCategory($id){
          $category = Category::find($id);
          $oldImage=$category->image;
          if ($category) {
             $category->delete();
            //  unlink($oldImage);
             return redirect()->route('home');
    }
    else 
    // Handle the case when the product is not found
    return redirect()->back()->with('error', 'category not found.');
}
}    


    
    
