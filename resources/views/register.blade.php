<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <title>Registeration</title>
</head>
<body>
    <form id="register" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="name">
    @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
    @endif

    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email">
    @if ($errors->has('email'))
        <span class="error">{{ $errors->first('email') }}</span>
    @endif

    <input type="password" name="password" placeholder="password">
    @if ($errors->has('password'))
        <span class="error">{{ $errors->first('password') }}</span>
    @endif

    <textarea name="adress" id="address" placeholder="address"></textarea>
    @if ($errors->has('adress'))
        <span class="error">{{ $errors->first('adress') }}</span>
    @endif

    <input type="file" name="image">
    @if ($errors->has('image'))
        <span class="error">{{ $errors->first('image') }}</span>
    @endif

    <button type="submit">Register</button>
    
    </form>
</body>
</html>