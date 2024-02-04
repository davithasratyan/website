<div id="mini-slider-captions" class="carousel slide mini-slider" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#mini-slider-captions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#mini-slider-captions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#mini-slider-captions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        @foreach($favorites as $key => $favorite)
        <div class="carousel-item mini-slider-item {{ $key === 0 ? 'active' : '' }}">
            <a href="{{route('page', ['id'=>$favorite->id])}}">
            <img src="{{asset('storage/images/mainImage/' . $favorite->main_image)}}" class="d-block w-100" alt="{{$favorite->title}}">
            <div class="carousel-caption mini-slider-caption d-none d-md-block">
                <h5>{{ Str::limit($favorite->title, 90, '...') }}</h5>
            </div>
            </a>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mini-slider-captions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon mini-slider-btn" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mini-slider-captions" data-bs-slide="next">
        <span class="carousel-control-next-icon mini-slider-btn" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
