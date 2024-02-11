<div class="topbar d-flex">
    <div class="toggle">
        <ion-icon name="menu-outline"></ion-icon>
    </div>
    <div class="search">
        <label>
            <form action="{{ route('searchArticle') }}" method="get">
                @csrf
            <input type="text" placeholder="Որոնել" name="q">
                <button type="submit" class="border-0 searchAdmin">
                    <ion-icon name="search-outline" class="searchBtn"></ion-icon>
                </button>
            </form>
        </label>
    </div>
    <div>
        @if(auth()->user()->role === 'admin')
            <button class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                {{auth()->user()->name}}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">
                        <form action="{{route('profile.edit')}}" method="get">
                            <button type="submit" class="btn">Profile</button>
                        </form>
                    </a></li>
                <li><a class="dropdown-item" href="#">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn">Sign out</button>
                        </form>
                    </a></li>
            </ul>
        @endif
    </div>
</div>

