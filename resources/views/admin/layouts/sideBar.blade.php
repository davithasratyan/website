<div class="navigation">
    @if(auth()->check() && auth()->user()->role == 'admin' || auth()->check() && auth()->user()->role == 'moderator')
        <ul>
            <li>
                <a href="#">
                        <span class="icon">
                            <img src="{{asset('assets/icons/x-icon.png')}}" alt="Icon">
                        </span>
                    <span class="title mt-2">sPanel</span>
                </a>
            </li>

            <li>
                <a href="{{route('adminPanel')}}">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                    <span class="title">Գլխավոր</span>
                </a>
            </li>

            <li>
                <a href="{{route('new_post')}}">
                        <span class="icon">
<ion-icon name="document-outline"></ion-icon>
                        </span>
                    <span class="title">Ավելացնել լուր</span>
                </a>
            </li>

            <li>
                <a href="{{route('mainPage')}}">
                        <span class="icon">
<ion-icon name="globe-outline"></ion-icon>
                        </span>
                    <span class="title">Անցնել կայք</span>
                </a>
            </li>
            @endif
            @if(auth()->check() && auth()->user()->role == 'admin')
                <li>
                    <a href="{{route('newCategory')}}">
                        <span class="icon">
<ion-icon name="pencil-outline"></ion-icon>
                        </span>
                        <span class="title">Ավելացնել կատեգորիա</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('addMediaIcons')}}">
                        <span class="icon">
<ion-icon name="heart-outline"></ion-icon>
                        </span>
                        <span class="title">Ավելացնել սոցցանց</span>
                    </a>
                </li>
        </ul>
    @endif
</div>
