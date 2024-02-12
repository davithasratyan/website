<div class="card my-4">
    <img class="card-img-top photo-card-image" src="{{asset('storage/images/mainImage/' . $photo->main_image)}}" alt="Card image cap">
    <div class="card-body photo-card-body">
        <h5 class="card-title photo-card-title">{{ Str::limit(strip_tags($photo->title), 110, '...') }}</h5>
    </div>
</div>
