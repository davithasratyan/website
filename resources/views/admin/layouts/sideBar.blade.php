<div class="sidebar-brand">
    <h2>sPanel</h2>
</div>
<ul class="sidebar-nav">
    @if(auth()->check() && auth()->user()->role == 'admin' || auth()->check() && auth()->user()->role == 'moderator')
    <li>
        <a class="fs-6" href="{{route('adminPanel')}}"><i class="fa fa-home fs-5"></i>Գլխավոր</a>
    </li>
    <li>
        <a class="fs-6" href="{{route('new_post')}}"><i class="fa fa-file-text-o fs-5"></i>Ավելացնել լուր</a>
    </li>
    <li>
        <a class="fs-6" href="{{route('mainPage')}}"><i class="fa fa-globe fs-5"></i>Անցնել կայք</a>
    </li>
    @endif
    @if(auth()->check() && auth()->user()->role == 'admin')
    <li>
        <a class="fs-6" href="{{route('newCategory')}}"><i class="fa fa-pencil fs-5"></i>Ավելացնել կատեգորիա</a>
    </li>
    <li>
        <a class="fs-6" href="{{route('addMediaIcons')}}"><i class="fa fa-heart-o"></i>Ավելացնել սոցցանց</a>
    </li>
    @endif
</ul>
