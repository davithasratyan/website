<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8852491f3e.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/styles/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/styles/mediaCss.css')}}" rel="stylesheet">
    <link href="{{asset('assets/styles/articlePageStyle.css')}}" rel="stylesheet">
    <link rel="icon" href="{{asset('assets/icons/x-icon.png')}}" type="image/x-icon">
    <title>@yield('title', 'Լրահոս')</title>
</head>
<body>

<header>
    @include('mainPage.layouts.header')
</header>

<main>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-7">
                <section class="py-5">
                    <h5 class="text-start news-category-title">Լրահոս</h5>
                @foreach($posts as $post)
                        <a href="{{route('page', ['id'=>$post->id])}}" class="text-dark">
                    @include('mainPage.components.card', ['post'=>$post])
                        </a>
                @endforeach
                </section>
            </div>
        </div>
    </div>
</main>

<footer>
    @include('mainPage.layouts.footer')
</footer>

<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('assets/js/main-script.js')}}"></script>
</body>
</html>
