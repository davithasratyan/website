@extends('mainPage.layouts.app')
@section('title', $category->category_name)
@section('content')
    <section>
        <h4 class="category-page-title">{{$category->category_name}}</h4>
        @foreach($categoryPosts as $categoryPost)
            @if($categoryPost->status !== 0)
            <a href="{{route('page', ['id'=>$categoryPost->id])}}">
                <div class="card my-5 border-0" style="max-width: 710px;">
                    <div class="row g-0">
                        <div class="col-md-4 col-sm-4 d-flex align-items-center card_image-block">
                            <img src="{{asset('storage/images/mainImage/' . $categoryPost->main_image)}}"
                                 class="img-fluid" alt="{{$categoryPost->title}}">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{Str::limit($categoryPost->title, 120, '...')}}</h5>
                                <p class="card-text card-date"><small
                                        class="text-muted">{{ \Carbon\Carbon::parse($categoryPost->time_date)->isoFormat('DD MMMM Y', 'months') }}</small>
                                </p>
                                <div class="card-text text-dark card-article">{!!Str::limit(strip_tags($categoryPost->article), 80, '...')!!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endif
        @endforeach
            <div class="d-flex justify-content-center">
                {!! $categoryPosts->links() !!}
            </div>
    </section>
@endsection
