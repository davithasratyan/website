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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@1.10.0/dist/css/lightgallery.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@1.10.0/dist/js/lightgallery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@1.10.0/dist/js/plugins/lg-thumbnail.min.js"></script>
    <link rel="icon" href="{{asset('assets/icons/x-icon.png')}}" type="image/x-icon">
    <title>@yield('title')</title>
    <meta name="keywords" content="նորություններ, լուրեր, լուր, մամուլ, լրատվական,  norutyunner, lurer" />
    <meta property="og:url"  content="@yield('url')" />
    <meta property="og:type" content="article" />
    <meta property="og:title"  content="@yield('ogTitle')" />
    <meta property="og:description"  content="@yield('description')" />
    <meta property="og:image"   content="@yield('image')" />
</head>
<body>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<header>
    @include('mainPage.layouts.header')
</header>

<main>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-7">
                @yield('content')
            </div>
            <div class="col-md-4">
                <aside>
                    @include('mainPage.layouts.sideBar')
                </aside>
            </div>
        </div>
    </div>
</main>

<footer>
    @include('mainPage.layouts.footer')
</footer>

<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('assets/js/main-script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@1.10.0/dist/js/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@1.10.0/dist/js/plugins/lg-thumbnail.min.js"></script>
</body>
</html>
