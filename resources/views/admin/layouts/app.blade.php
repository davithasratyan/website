<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Your HTML head section -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/8852491f3e.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/cnq0lru5kyw1l91wheqtvnshbrf9ybehmpbfy8ltckq29dbs/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="icon" href="{{asset('assets/icons/x-icon.png')}}" type="image/x-icon">
    <link href="{{asset('assets/admin/css/adminStyle.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/mediaStyles.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <title>sPanel</title>
</head>
<body>
<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/cnq0lru5kyw1l91wheqtvnshbrf9ybehmpbfy8ltckq29dbs/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<div class="wrapper">
    <!-- =============== Navigation ================ -->
    @include('admin.layouts.sideBar')

    <!-- ========================= Main ==================== -->
    <div class="main">
        @include('admin.layouts.header')

        <!-- ================ Order Details List ================= -->
        <div class="details">
            <div class="recentOrders">
                @yield('admin-content')
            </div>
        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('assets/admin/js/adminScript.js')}}"></script>
<script src="{{asset('assets/admin/js/refreshDate.js')}}"></script>
<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</body>
</html>
