<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5; 
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
        .invoice {
            height: 400px;
            width: 400px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-color: white; 
            }
        .invoice h1 {
            margin-bottom: 20px;
            color: #333; 
        }
        .invoice p {
            margin: 10px 0;
            color: #555; 
        }
    </style>
    <title>Invoice</title>
</head>
<body>
@include('bar')

    <div class="invoice">
        <h1>Invoice</h1>
        @auth
        <p>Your name: {{ auth()->user()->name }}</p>
        <p>Your email: {{ auth()->user()->email }}</p>
        <p>Your address: {{ auth()->user()->adress }}</p>
        <p>Product name: {{ $product->name }}</p>
        <p>Product price: {{ $product->price }}</p>
        <h3>you are welcome</h3>
        @endauth
    </div>
</body>
</html>