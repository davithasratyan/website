<a href="{{route('page', ['id'=>$post->id])}}">
<div class="card my-5 border-0" style="max-width: 710px;">
    <div class="row g-0">
        <div class="col-md-4 col-sm-4 d-flex align-items-center card_image-block">
            <img src="{{asset('storage/images/mainImage/' . $post->main_image)}}" class="img-fluid" alt="...">
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="card-body">
                <h5 class="card-title">{{Str::limit($post->title, 100, '...')}}</h5>
                <p class="card-text card-date">
                    <small class="text-muted">
                        @php
                            try {
                                echo \Carbon\Carbon::parse($post->time_date)->isoFormat('DD MMMM Y, HH:mm');
                            } catch (\Exception $e) {
                                echo '';
                            }
                        @endphp
                    </small>
                </p>
                <div class="card-text card-article">{!!Str::limit($post->article, 100, '...')!!}</div>
            </div>
        </div>
    </div>
</div>

</a>


