@php
    $categories = getCategories ();
 @endphp

<nav class="navbar navbar-expand-lg fixed-top border-0">
    <div class="container px-0">
        <a class="navbar-brand ms-2" href="{{route('mainPage')}}">
   <img src="{{asset('assets/icons/logo.png')}}" width="150" height="auto" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="openButton">
                            <i class="fa-solid fa-bars" style="color: #fff"></i>
                        </span>
            <span class="closeButton">
                            <i class="fa-solid fa-xmark" style="color: #fff"></i>
                        </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                @foreach ($categories as $category)
                    @if($category->parent_id == 0)
                        <li class="nav-item @if(count($category->children)) dropdown @endif">
                            <a class="nav-link @if(count($category->children)) dropdown-toggle @endif"
                               @if(count($category->children)) id="navbarDropdown_{{$category->id}}" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false"
                               @endif href="{{ route('postsByCategory', ['id'=>$category->id, 'category' => $category->category]) }}">
                                {{ $category->category_name }}
                            </a>
                            @if(count($category->children))
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown_{{$category->id}}">
                                    @foreach($category->children as $subcategory)
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{ route('postsByCategory', ['id'=>$subcategory->id, 'category' => $subcategory->category]) }}">
                                                {{ $subcategory->category_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
            <form action="{{route('search')}}" method="get" class="d-flex search">
                <button type="submit" class="border-0">
                    <span class="fa fa-search"></span>
                </button>
                <input type="search" name="q">
            </form>
        </div>
    </div>
</nav>
