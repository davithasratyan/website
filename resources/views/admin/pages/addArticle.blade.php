@extends('admin.layouts.app')
@section('admin-content')
    <section>
    <form action="{{route('save_new_post')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <input type="text" class="form-control formBorders" placeholder="Վերնագիր" name="title">
                <textarea id="mytextarea" rows="26" class="form-control" name="article"></textarea>
                <input type="text" class="form-control formBorders" placeholder="youtube.com կայքի հղումը" name="yt_link">
                <input type="text" class="form-control formBorders" placeholder="Հանգուցային բառեր" name="tags">
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="woodList">
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="{{ $category->category . 'Check' }}" name="category_checks[]" value="{{ $category->id }}">
                                    <label class="form-check-label" for="{{ $category->category . 'Check' }}">
                                        {{ $category->category_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="woodList">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mainCheck" name="mainCheck">
                                <label class="form-check-label" for="mainCheck">
                                    Գլխավոր սլայդեր
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="boldCheck" name="boldCheck">
                                <label class="form-check-label" for="boldCheck">
                                    Բոլդ լրահոսում
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hideCheck" name="hideCheck">
                                <label class="form-check-label" for="hideCheck">
                                    Չցուցադրել լրահոսում
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="favCheck" name="favCheck">
                                <label class="form-check-label" for="favCheck">
                                    Խմբագրի ընտրանի
                                </label>
                            </div>

                        </div>
                        <div class="woodList">
                            <div id="fileInputContainer">
                                <label for="fileInput">Ընտրել լուսանկար</label>
                                <input type="file" class="form-control my-2" id="fileInput" name="main_image">
                            </div>
                        </div>
                        <div class="woodList photoList">
                            <label for="multiUploadInput">Ներբեռնել ֆոտոշարք</label>
                            <input type="file" class="form-control my-2" id="multiUploadInput" name="multi_images[]" multiple>
                        </div>
                        <div class="woodList refreshDate">
                            <h6>Հրապարակման ամսաթիվ</h6>
                            <div class="d-flex align-items-center justify-content-between">
                            <input class="dateBox" type="text" id="dateInput" name="date">
                             <i class="fa fa-refresh" id="refreshDate" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="woodList">
                            <h6>Հրապարակման կարգավիճակ</h6>
                            <select class="form-select" name="status" id="status">
                                <option value="0">Սևագիր</option>
                                <option value="1">Հրապարակված</option>
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
    </section>
@endsection
