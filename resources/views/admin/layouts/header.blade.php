<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="dropdown float-end px-5 me-5">
                @if(auth()->user()->role === 'admin')
                <button class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
            <div class="float-end">
                <form action="{{ route('searchArticle') }}" method="get"  class="d-flex search">
                    @csrf
                    <button type="submit" class="border-0">
                        <span class="fa fa-search"></span>
                    </button>
                    <input type="search" name="q" class="adminSearch">
                </form>
            </div>
        </div>
    </div>
</nav>
