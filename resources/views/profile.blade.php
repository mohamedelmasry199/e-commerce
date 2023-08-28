<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>Profile Page</title>
</head>
<body>
@include('bar')
    <div class="sidenav">
      <div class="profile">
      <img src="{{ asset('/'. Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
            <div class="name">
                {{Auth::user()->name}}
            </div>
        </div>
    </div>


    <div class="main">
        <h2>your information</h2>
        <div class="card">
            <div class="card-body">
                <!-- <i class="fa fa-pen fa-xs edit"></i> -->
                <table>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{Auth::user()->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{Auth::user()->email}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>{{Auth::user()->adress}}</td>
                        </tr>
                        <tr>
                            <td>Your Products</td>
                            <td>:</td>
                            <td>@foreach ($products as $index => $product)
                                {{$product->name}}
                                @if ($index < count($products)-1)
                                ,
                                @endif                                
                            @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</div>







