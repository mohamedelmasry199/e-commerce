<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    
    <title>Document</title>
</head>
<body>

    
    @include('bar')

    <form id="login" action="{{ route('login') }}" method="POST">
        <h1>login</h1>
        @csrf
        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
        @if ($errors->has('email'))
            <span class="error">{{ $errors->first('email') }}</span>
        @endif
        <input type="password" name="password" placeholder="Password">
        @if ($errors->has('password'))
            <span class="error">{{ $errors->first('password') }}</span>
        @endif
        <button type="submit">Login</button>
        <a href="{{route('register')}}">i don't have account</a>
        @if(session('registered'))
          <div class="alert alert-success">
            You have successfully registered. Please log in with your new credentials.
          </div>
@endif



    </form>
        
     
    </form>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>