@extends('admin.layouts.app')
@section('admin-content')
    <section class="mt-5">
    <form action="{{route('addIcon')}}" method="post">
        @csrf
        <div class="mb-3">
            <input type="text" name="icon" placeholder="Ավելացնել սոցցանց: Օրինակ՝ telegram" class="form-control">
        </div>

        <div class="mb-3">
            <input type="text" name="color" placeholder="Ավելացնել գույն" class="form-control">
        </div>

        <div class="mb-3">
            <input type="text" name="link" placeholder="Ավելացնել հղում" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Ավելացնել</button>
        @if(Session::has('errorMessage'))
            <p class="alert alert-warning mt-2">{{ Session::get('errorMessage') }}</p>

        @elseif(Session::has('successMessage'))
            <p class="alert alert-info mt-2">{{ Session::get('successMessage') }}</p>
        @endif
    </form>

        <hr>
        <div class="col-md-12 my-5">
            <form action="{{route('deleteMediaIcon')}}" method="post">
                @csrf
                <select class="form-select" name="id">
                    <option selected>Ջնջել սոցցանցը</option>
                    @foreach($icons as $icon)
                        <option value="{{$icon->id}}">
                            {{$icon->icon}}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-danger mt-5" name="delete">DELETE</button>
            </form>
        </div>

        <hr>
        <div class="col-md-12 my-5">
            <form action="{{route('addContacts')}}" method="post">
                @csrf
                <div class="mb-3">
                    <input type="text" name="phone" placeholder="Ավելացնել հեռախոսահամար" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="text" name="email" placeholder="Ավելացնել մեյլ" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Ավելացնել</button>
            </form>
        </div>
    </section>
@endsection
