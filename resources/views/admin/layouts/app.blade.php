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
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>
    <link href="{{asset('assets/Admin/css/adminStyle.css')}}" rel="stylesheet">
    <link href="{{asset('assets/Admin/css/mediaStyles.css')}}" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<div id="wrapper">
    <aside id="sidebar-wrapper">
        @include('admin.layouts.sideBar')
    </aside>

    <div id="navbar-wrapper">
        @include('admin.layouts.header')
    </div>

    <main class="px-5">
        @yield('admin-content')
    </main>
</div>

<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('assets/Admin/js/adminScript.js')}}"></script>
<script src="{{asset('assets/admin/js/refreshDate.js')}}"></script>
</body>
</html>
