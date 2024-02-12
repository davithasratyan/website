<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Yandex.RTB -->
    <script>window.yaContextCb=window.yaContextCb||[]</script>
    <script src="https://yandex.ru/ads/system/context.js" async></script>
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
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=65ba105e3625b4001a8bcdee&product=inline-share-buttons&source=platform" async="async"></script>    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B1D51QPBYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-B1D51QPBYG');
    </script>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="նորություններ, լուրեր, լուր, մամուլ, լրատվական, lurer" />

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="@yield('googleName')">
    <meta itemprop="description" content="@yield('googleDes')">
    <meta itemprop="image" content="@yield('googleImg')">
    <meta name="copyright" content="Copyright &copy; 2024 MediaNess.site. All rights reserved." />

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="@yield('twitterTitle')">
    <meta name="twitter:description" content="@yield('twitterDesc')">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="@yield('twitterImg')">

    <!-- Open Graph data -->
    <meta property="og:title" content="@yield('ogTitle')" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="@yield('ogUrl')" />
    <meta property="og:image" content="@yield('ogImage')" />
    <meta property="og:description" content="@yield('ogDes')" />
    <meta property="og:site_name" content="mediamess.site"/>
    <!-- meta tags END -->
</head>
<body>
@php
    $categories = getCategories ();
@endphp
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
<footer class="footer-section" id="#footer">
    @include('mainPage.layouts.footer')
</footer>

<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('assets/js/main-script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@1.10.0/dist/js/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@1.10.0/dist/js/plugins/lg-thumbnail.min.js"></script>
</body>
</html>
