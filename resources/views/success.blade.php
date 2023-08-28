<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        .container {
            text-align: center;
            padding: 20px;
        }

        .success-message {
            background-color: #f0f8ff;
            border: 1px solid #87ceeb;
            padding: 20px;
            border-radius: 5px;
        }

        h1 {
            color: #228b22;
            font-size: 28px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            color: #333;
        }
    </style>
<body>
    <div class="container">
        <h1>Order Placed Successfully!</h1>
        <p>Thank you for your order. Your order has been successfully placed.</p>
        <a href="{{route('home')}}">back to category</a>
    </div>

</body>
</html>

