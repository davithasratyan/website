@extends('admin.layouts.app')
@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('addNewCategory')}}" method="post">
                @csrf
                <div class="my-3">
                    <input type="text" class="form-control" name="category" placeholder="Կատեգորիա">
                </div>
                <div class="my-3">
                    <input type="text" class="form-control" name="category_name" placeholder="Կատեգորիայի անվանումը">
                </div>
                <div class="my-3">
                    <select class="form-select" name="parentCategory">
                        <option value="0">Ընտրել կատեգորիա</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-3">
                    <input type="checkbox" name="category_status" id="categoryCheck" value="1">
                    <label for="categoryCheck">Ցուցադրե՞լ կայքի գլխավոր էջում </label>
                </div>
                <button type="submit" class="btn btn-primary">Հաստատել</button>
            </form>
        </div>
        <div class="col-md-12">
            <form action="{{route('deleteCategory')}}" method="get">
                <select name="categoryId" class="form-select my-5">
                    <option value="0">Ընտրել կատեգորիա</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
                <input type="submit" class="btn btn-outline-danger" value="Ջնջել">
            </form>
        </div>
    </div>
@endsection
