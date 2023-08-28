<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* Reset some default browser styles */
body, h1, h2, table {
    margin: 20px;
    padding: 20px;
}
.header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 0px;
            z-index: 1000; 
        }

/* Basic styling for the cart */
.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.cart-table th, .cart-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

.cart-table th {
    background-color: #f2f2f2;
}

.cart-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.alert {
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    font-weight: bold;
}

.success {
    background-color: #dff0d8;
    color: #3c763d;
}

.error {
    background-color: #f2dede;
    color: #a94442;
}

.checkout-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

</style>
@include('bar')
<body>
<h1>Your Cart</h1>

@if(session('success'))
    <div class="alert success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert error">
        {{ session('error') }}
    </div>
@endif

<table class="cart-table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>subtotal</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                    <form action="/cart/remove/{{ $id }}">
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm cart_remove"><i class="fa fa-trash-o"></i> Delete</button>
                        </form>
                        <form action="category/product/buy/{{ $id }}" method="POST">
                          @csrf
                          <button type="submit">Buy Now</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td colspan="5" style="text-align:right;"><h3><strong>Total: ${{ $total }}</strong></h3></td>
        </tr>
    </tbody>
</table>

    <form action="{{ route('order.place') }}" method="POST">
      @csrf
      <button type="submit">Place Order</button>
    </form>

</body>
</html>