<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Home</title>
</head>
<body>
@include('bar')


    <main>
        <section class="categories">
            <h2>Categories</h2>
            <div class="category-list">
                @foreach ($categories as $category)
                    <a href="{{ route('category.products', ['category' => $category->name]) }}" class="category">
                        <div class="category-image">
                        <img src="{{ asset('/'.$category->image) }}">
                        </div>
                        <div class="category-name">{{ $category->name }}</div>
        @auth
                @if( Auth::user()->type == 'admin')
                <form action="{{route('category.update',$category->id)}}">               
                  <button>Update</button>
                </form>
                <form action="{{route('category.delete',$category->id)}}" method="post">
                  @method('DELETE')
                  @csrf               
                 <button>Delete</button>
                </form>
                 @endif
         @endauth
                    </a>
                @endforeach
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Your E-Commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
