<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('product.edit', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="product_name">Product Name</label>
    <input type="text" id="product_name" name="name" value="{{ old('name', $product->name) }}">
    @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
    @endif

    <label for="product_price">Product Price</label>
    <input type="text" id="product_price" name="price" value="{{ old('price', $product->price) }}">
    @if ($errors->has('price'))
        <span class="error">{{ $errors->first('price') }}</span>
    @endif

    <label for="product_description">Product Description</label>
    <input type="text" id="product_description" name="description" value="{{ old('description', $product->description) }}">
    @if ($errors->has('description'))
        <span class="error">{{ $errors->first('description') }}</span>
    @endif

    <label for="product_availability">Product Availability</label>
    <input type="text" id="product_availability" name="product_availability" value="{{ old('product_availability', $product->product_availability) }}">
    @if ($errors->has('product_availability'))
        <span class="error">{{ $errors->first('product_availability') }}</span>
    @endif

    <label for="category_id">Category ID</label>
    <input type="text" id="category_id" name="category_id" value="{{ old('category_id', $product->category_id) }}">
    @if ($errors->has('category_id'))
        <span class="error">{{ $errors->first('category_id') }}</span>
    @endif

    <label for="image">Product Image</label>
    <input type="file" id="image" name="image">
    @if ($errors->has('image'))
       <span class="error">{{ $errors->first('image') }}</span>
    @endif

    @if(!$errors->has('image') && $product->image) <!-- Check if there are no errors and there's an existing image -->
       <p>Current Image:</p>
       <img src="{{ asset('' . $product->image) }}" alt="Current Image">
    @endif


    <input type="submit">
</form>

</body>
</html>
