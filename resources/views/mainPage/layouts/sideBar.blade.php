@php
    $telegramIcon = getTelegram();
@endphp

<div class="row">
    <div class="col-md-12">
        <section class="block">
            @include('mainPage.components.miniSlider')
        </section>
    </div>
    <div class="col-md-12">
        <div class="subTel">
            <h6 class="subTel_title"> Հետևեք մեզ Տելեգրամում՝ </h6>
            @foreach($telegramIcon as $tel)
                <a class="px-2 mt-2" href="{{$tel->link}}" target="_blank">@include('mainPage.icons.telegram')</a>
            @endforeach
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('feed')}}" class="text-start news-category-title">Լրահոս</a>
                <hr>
                <section class="timeline">
                    @if($posts)
                        @foreach($posts as $post)
                            @if($post->articleStatus->hideCheck !== 1)
                                <a href="{{route('page', ['id'=>$post->id])}}" class="news-card">
                                    <img src="{{ asset('storage/images/mainImage/' . $post->main_image) }}">
                                    <span
                                        class="@if($post->articleStatus->boldCheck == 1) fw-bolder @endif">{{ Str::limit($post->title, 75, '...') }}</span>
                                    <time class="timeago" datetime="{{ $post->time_date }}">
                                        {{ $post->time_date->locale('hy')->diffForHumans() }}
                                    </time>
                                </a>
                            @endif
                        @endforeach
                    @endif
                </section>

            </div>
            <div class="col-md-12">
                @foreach($categories as $category)
                    @if($category->category == 'photos')
                        <a class="news-category-title text-start"
                           href="{{ route('postsByCategory', ['id'=>$category->id, 'category' => $category->category]) }}">Ֆոտոշարք</a>
                    @endif
                @endforeach
                <hr>
                <section class="d-flex flex-column justify-content-center align-items-center">
                    @foreach($photos as $photo)
                        <a href="{{route('page', ['id'=>$photo->id])}}}}">
                            @include('mainPage.components.photoCard', ['photo'=>$photo])
                        </a>
                    @endforeach
                </section>
            </div>
        </div>
    </div>
</div>
