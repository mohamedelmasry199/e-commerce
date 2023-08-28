<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    <title>Document</title>
</head>
<body>
@include('bar')

<div class="card-container">   
@foreach ($products as $product)
<a href="{{ route('product.show', ['id' => $product->id]) }}" class="card-link">
<div class="card">
<img src="{{ asset('/' . $product->image) }}" alt="{{ $product->name }}">
  <h1>{{$product->name}}</h1>
  <p class="price">price:{{$product->price}}</p>
  <p>{{$product->description}}</p>
  @auth

 @if( Auth::user()->type == 'admin')
  <form action="{{route('product.update',$product->id)}}">               
     <button>Update</button>
  </form>
  <form action="{{route('product.delete',$product->id)}}" method="post">
    @method('DELETE')
    @csrf               
    <button>Delete</button>
</form>
@else
  <form action="{{ route('product.buy', ['id' => $product->id]) }}" method="POST">
    @csrf
    <button type="submit">Buy Now</button>
</form>

  <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <button type="submit">Add to Cart</button>
    </form>
  
  @endif
  @if ($product->id === session('added_product_id') && session('success'))
    <div class="flash-message">
        {{ session('success') }}
    </div>
    @endif
  @endauth

</div>
@endforeach  
</div>
</body>
</html>
