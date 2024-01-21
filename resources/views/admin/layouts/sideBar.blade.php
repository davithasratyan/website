{{--<div class="sidebar-brand">--}}
{{--    <h2>sPanel</h2>--}}
{{--</div>--}}
{{--<ul class="sidebar-nav">--}}
{{--    @if(auth()->check() && auth()->user()->role == 'admin' || auth()->check() && auth()->user()->role == 'moderator')--}}
{{--    <li>--}}
{{--        <a class="fs-6" href="{{route('adminPanel')}}"><i class="fa fa-home fs-5"></i>Գլխավոր</a>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <a class="fs-6" href="{{route('new_post')}}"><i class="fa fa-file-text-o fs-5"></i>Ավելացնել լուր</a>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <a class="fs-6" href="{{route('mainPage')}}"><i class="fa fa-globe fs-5"></i>Անցնել կայք</a>--}}
{{--    </li>--}}
{{--    @endif--}}
{{--    @if(auth()->check() && auth()->user()->role == 'admin')--}}
{{--    <li>--}}
{{--        <a class="fs-6" href="{{route('newCategory')}}"><i class="fa fa-pencil fs-5"></i>Ավելացնել կատեգորիա</a>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <a class="fs-6" href="{{route('addMediaIcons')}}"><i class="fa fa-heart-o"></i>Ավելացնել սոցցանց</a>--}}
{{--    </li>--}}
{{--    @endif--}}
{{--</ul>--}}

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark position-fixed fixed-top fixed-bottom" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">sPanel</span>
    </a>
    <hr>
    @if(auth()->check() && auth()->user()->role == 'admin' || auth()->check() && auth()->user()->role == 'moderator')
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item py-2">
            <a href="{{route('adminPanel')}}" class="nav-link active" aria-current="page">
                <i class="fa fa-home fs-5"></i>
                Գլխավոր
            </a>
        </li>
        <li class="py-2">
            <a href="{{route('new_post')}}" class="nav-link text-white">
                <i class="fa fa-file-text-o fs-5"></i>
                Ավելացնել լուր
            </a>
        </li>
        <li class="py-2">
            <a href="{{route('mainPage')}}" class="nav-link text-white">
                <i class="fa fa-globe fs-5"></i>
                Անցնել կայք
            </a>
        </li>
    @endif
    @if(auth()->check() && auth()->user()->role == 'admin')
        <li class="py-2">
            <a href="{{route('newCategory')}}" class="nav-link text-white">
                <i class="fa fa-pencil fs-5"></i>
                Ավելացնել կատեգորիա
            </a>
        </li>
        <li class="py-2">
            <a href="{{route('addMediaIcons')}}" class="nav-link text-white">
                <i class="fa fa-heart-o"></i>
                Ավելացնել սոցցանց
            </a>
        </li>
    </ul>
    @endif
    <hr>
</div>
