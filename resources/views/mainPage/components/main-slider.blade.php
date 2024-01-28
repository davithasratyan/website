<div id="carouselCaptions" class="carousel slide main-slider" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($sliderPosts as $key => $sliderPost)
        <div class="carousel-item main-slider-item {{ $key === 0 ? 'active' : '' }}">
            <a href="{{route('page', ['p'=>$sliderPost->id])}}">
              <img src="{{asset('storage/images/mainImage/' . $sliderPost->main_image)}}" class="d-block w-100" alt="{{$sliderPost->title}}">
              <div class="carousel-caption main-slider-caption d-none d-md-block">
                  <h5>{{ Str::limit($sliderPost->title, 110, '...') }}</h5>
            </div>
            </a>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
