{{--<div class="card my-4" style="max-width: 710px;">--}}
{{--    <img class="card-img-top img-fluid" src="{{asset('storage/images/mainImage/' . $photo->main_image)}}" alt="Card image" style="object-fit: cover; width: 100%; height: 220px;">--}}
{{--    <div class="card-body photo-card-body">--}}
{{--        <h5 class="card-title photo-card-title">{{ Str::limit($photo->title, 110, '...') }}</h5>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="card my-4">
    <img class="card-img-top" src="{{asset('storage/images/mainImage/' . $photo->main_image)}}" alt="Card image cap">
    <div class="card-body photo-card-body">
        <h5 class="card-title photo-card-title">{{ Str::limit($photo->title, 110, '...') }}</h5>
    </div>
</div>
