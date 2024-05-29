@extends('mainPage.layouts.app')
@if($singlePost->title !== null)
    @section('title', $singlePost->title)
@else
    @section('title', 'MediaMess.site')
@endif
@section('description', $singlePost->title)
@section('googleName', $singlePost->title)
@section('googleDes', Str::limit(strip_tags($singlePost->article), 100))
@section('googleImg', asset('storage/images/mainImage/' . $singlePost->main_image))
@section('twitterTitle', $singlePost->title)
@section('twitterDesc', Str::limit(strip_tags($singlePost->article), 100))
@section('twitterImg', asset('storage/images/mainImage/' . $singlePost->main_image))
@section('ogTitle', $singlePost->title)
@section('ogUrl', route('page', ['id'=>$singlePost->id]))
@section('ogImage', asset('storage/images/mainImage/' . $singlePost->main_image))
@section('ogDes', $singlePost->title)

@section('content')
    <section class="category_article_block">
        @if($singlePost->title)
            <h1 class="category_title_block text-start">{{$singlePost->title}}</h1>
        @endif
        @if($singlePost->categories)
            @foreach($singlePost->categories as $category)
                <span class="articleCat">{{$category->category_name}}</span>
            @endforeach
        @endif
        <span class="time">
                     @php
                         try {
                             echo \Carbon\Carbon::parse($singlePost->time_date)->isoFormat('DD MMMM Y, HH:mm');
                         } catch (\Exception $e) {
                             echo '';
                         }
                     @endphp
            </span>
        <div class="category_main_block ratio ratio-16x9">
            @if(isset($singlePost->yt_link))
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{$singlePost->yt_link}}"
                        frameborder="0" allowfullscreen></iframe>
            @else
                <img
                    src="@if($singlePost->main_image){{asset('storage/images/mainImage/' . $singlePost->main_image)}} @endif"
                    alt="Main Image">
            @endif
        </div>

        <div class="article">
            <!-- Yandex.RTB R-A-5980996-9 -->
            <div id="yandex_rtb_R-A-5980996-9"></div>
            <script>
                window.yaContextCb.push(()=>{
                    Ya.Context.AdvManager.render({
                        "blockId": "R-A-5980996-9",
                        "renderTo": "yandex_rtb_R-A-5980996-9"
                    })
                })
            </script>
            {!! $singlePost->article !!}
        </div>
    </section>
    <section>
        @if($singlePost->articleImages->isNotEmpty())
            <div id="lightgallery">
                @foreach($singlePost->articleImages as $articleImage)
                    <a href="{{asset('storage/images/photoSeries/' . $articleImage->images)}}">
                        <img src="{{asset('storage/images/photoSeries/' . $articleImage->images)}}"
                             alt="{{$singlePost->title}}">
                    </a>
                @endforeach
            </div>
        @endif
    </section>
    <div>
        <div class="sharethis-inline-share-buttons"></div>
    </div>
    <section class="relatedArticles_block">
        @if(!empty($relatedPosts))
            <h5 class="relatedArticles_block_title">Այս թեմայով</h5>
            @foreach ($relatedPosts as $relatedPost)
                <a href="{{route('page', ['id'=>$relatedPost->post->id])}}" class="clearfix">
                    <div class="card my-5 border-0" style="max-width: 710px;">
                        <div class="row g-0">
                            <div class="col-md-4 col-sm-4 d-flex align-items-center card_image-block">
                                <img src="{{asset('storage/images/mainImage/' . $relatedPost->post->main_image)}}"
                                     class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="card-body">
                                    <h5 class="card-title relatedArticles_title">{{Str::limit($relatedPost->post->title, 180, '...')}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
    </section>

    <script>
        $(document).ready(function () {
            $("#lightgallery").lightGallery();
        });
    </script>
@endsection
