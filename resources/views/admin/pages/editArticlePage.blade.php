@extends('admin.layouts.app')
@section('admin-content')
    @foreach($posts as $post)
        <form action="{{route('store_updatedPost', ['id'=>$post->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <input type="text" class="form-control formBorders" placeholder="Վերնագիր" name="title" @if($post->title) value="{{$post->title}}" @endif>
                <textarea id="summernote" rows="150" class="form-control" name="article">@if($post->article){{$post->article}} @endif</textarea>
                <script>
                    $(document).ready(function() {
                        $('#summernote').summernote({
                            height: 600,
                            minHeight: null,
                            maxHeight: null,
                            focus: true
                        });
                    });
                </script>
                <input type="text" class="form-control formBorders" placeholder="youtube.com կայքի հղումը" name="yt_link" @if($post->yt_link) value="https://www.youtube.com/watch?v={{$post->yt_link}}" @endif>
                <input type="text" class="form-control formBorders" placeholder="Հանգուցային բառեր" name="tags" value="{{ implode(', ', $tagNames->toArray()) }}">
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="woodList">
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="{{ $category->category . 'Check' }}" name="category_checks[]" value="{{ $category->id }}"
                                           @if($post->categories->contains('id', $category->id)) checked @endif>
                                    <label class="form-check-label" for="{{ $category->category . 'Check' }}">
                                        {{ $category->category_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="woodList">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mainCheck" name="mainCheck" @if($post->articleStatus->post_id ==$post->id && $post->articleStatus->mainCheck==1) checked @endif >
                                <label class="form-check-label" for="mainCheck">
                                    Գլխավոր սլայդեր
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="boldCheck" name="boldCheck" @if($post->articleStatus->post_id ==$post->id && $post->articleStatus->boldCheck==1) checked @endif>
                                <label class="form-check-label" for="boldCheck">
                                    Բոլդ լրահոսում
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hideCheck" name="hideCheck" @if($post->articleStatus->post_id ==$post->id && $post->articleStatus->hideCheck==1) checked @endif>
                                <label class="form-check-label" for="hideCheck">
                                    Չցուցադրել լրահոսում
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="favCheck" name="favCheck" @if($post->articleStatus->post_id ==$post->id && $post->articleStatus->favCheck==1) checked @endif>
                                <label class="form-check-label" for="favCheck">
                                    Խմբագրի ընտրանի
                                </label>
                            </div>
                        </div>
                        <div class="woodList">
                            <div id="fileInputContainer">
                                <label for="fileInput">Ընտրել լուսանկար</label>
                                <input type="file" class="form-control my-2" id="fileInput" name="main_image">
                                @if($post->main_image)
                                    <div class="">
                                        <img class="img-thumbnail"
                                             src="{{asset('storage/images/mainImage/' . $post->main_image)}}"
                                             alt="Main Image">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="woodList">
                            <label for="multiUploadInput">Ներբեռնել ֆոտոշարք</label>
                            <input type="file" class="form-control my-2" id="multiUploadInput" name="multi_images[]" multiple>
                            @if($post->articleImages->isNotEmpty())
                                <div class="photoList">
                                @foreach($post->articleImages as $image)
                                        <div class="edit_images" id="image_{{$image->id}}" style="background-image: url('{{ asset('storage/images/photoSeries/' . $image->images) }}');">
                                            <a href="javascript:void(0);" onclick="deleteImage({{ $image->id }})">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="woodList refreshDate">
                            <h6>Հրապարակման ամսաթիվ</h6>
                            <div class="d-flex align-items-center justify-content-between">
                            <input class="dateBox form-control" type="text" id="currentTime" name="date" value="{{$post->time_date}}">
                            <i class="fa fa-refresh" id="refreshDateBtn" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="woodList">
                            <h6>Հրապարակման կարգավիճակ</h6>
                            <select class="form-select" name="status" id="status">
                                <option value="0" @if($post->status ==0) selected @endif>Սևագիր</option>
                                <option value="1" @if($post->status ==1) selected @endif>Հրապարակված</option>
                            </select>
                        </div>
                        <div class="woodList">
                            <button type="submit" class="submitBtn" name="submit">Պահպանել</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        @endforeach
    <!-- JavaScript -->
    <script>
        const currentTimeInput = document.getElementById('currentTime');
        const refreshDateBtn = document.getElementById('refreshDateBtn');

        refreshDateBtn.addEventListener('click', function () {
            updateTime(currentTimeInput);
        });

        function updateTime(dateInput) {  // Changed the parameter name to dateInput
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
                timeZone: 'Asia/Yerevan'
            };

            dateInput.value = new Date().toLocaleString('en-US', options);
        }

        function deleteImage(imageId) {
            $.ajax({
                type: 'DELETE',
                url: '{{ route("delete_image", ["id" => "_id_"]) }}'.replace('_id_', imageId),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#image_' + imageId).remove();
                    console.log('Image deleted successfully');
                },
                error: function (xhr, status, error) {
                    // Handle error, show a message, etc.
                    console.error('Error deleting image', error);
                }
            });
        }
    </script>
@endsection
