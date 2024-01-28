@extends('admin.layouts.app')
@section('admin-content')
    <section class="px-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Նյութի վերնագիր</th>
                <th scope="col">Կարգավիճակ</th>
                <th scope="col">Դիտումներ</th>
                <th scope="col">Օգտատեր</th>
                <th scope="col">Գործողություն</th>
            </tr>
            </thead>
            <tbody>
            @if($posts)
                @foreach($posts as $post)
                        <tr>
                            <td scope="row">
                                <a href="{{route('page', ['p'=>$post->id])}}" target="_blank" class="text-decoration-none">
                                <div class="articlePanelImage">
                                    <img
                                        src="@if($post->main_image) {{asset('storage/images/mainImage/' . $post->main_image)}} @endif"
                                        alt="" style="object-fit: cover">
                                </div>
                                 <span class="post_title pt-4">{{Str::limit($post->title, 100, '...')}}</span>
                                </a>
                            </td>
                            <td>
                                <div class="status">
                                    @if($post->status == 1)
                                        <span>Հրապարակված</span>
                                    @elseif($post->status == 0)
                                        <span>Սևագիր</span>
                                    @endif
                                </div>
                                <div class="date">{{$post->time_date}}</div>
                            </td>
                            <td>
                                <div class="view">
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    4
                                </div>
                            </td>
                            <td>
                    <span class="author">
                        {{auth()->user()->name}}
                    </span>
                            </td>
                            <td>
                                <!-- Update -->
                                <a href="{{route('edit_page', ['id'=>$post->id])}}" class="px-3 text-secondary editArticle">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <!-- Delete button trigger modal -->
                                <a type="button" class="px-3 text-danger deleteArticle" data-bs-toggle="modal"
                                   data-bs-target="#deleteModal_{{$post->id}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal_{{$post->id}}" tabindex="-1"
                                     aria-labelledby="deleteModalLabel_{{$post->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="deleteModalLabel_{{$post->id}}">Ջնջե՞լ
                                                    հոդվածը</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Փակել
                                                </button>
                                                <a href="{{route('delete_post', ['id'=>$post->id])}}" type="submit"
                                                   class="btn btn-danger">Այո</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $posts->links() !!}
        </div>
    </section>
@endsection
