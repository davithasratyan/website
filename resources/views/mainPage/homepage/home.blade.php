@extends('mainPage.layouts.app')
@section('title', 'MediaMess')
@section('content')
    <!-- Slider -->
    <section class="main-slider">
        @include('mainPage.components.main-slider', ['sliderPosts' => $sliderPosts])
    </section>
    <!-- End Slider -->

    <!-- Content -->
    <div class="row">
        <div class="col-md-12">
                @foreach($mainPageCategories as $category)
                @if($category->status == 1)
                    <section class="categories">
                        <div class="category-title-block">
                            <a href="{{ route('postsByCategory', ['id'=>$category->id, 'category' => $category->category]) }}">
                                <h5 class="category-title">{{$category->category_name}}</h5></a>
                        </div>
                    @foreach($category->posts()->latest()->take(2)->get() as $post)
                            @if($post->status !== 0)
                                <a href="{{route('page', ['id'=>$post->id])}}">
                                    @include('mainPage.components.card', ['post' => $post])
                                </a>
                            @endif
                    @endforeach
                    </section>
                @endif
                @endforeach
        </div>
    </div>
    <!-- End Content -->
@endsection


