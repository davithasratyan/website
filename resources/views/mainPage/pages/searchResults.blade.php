@extends('mainPage.layouts.app')
@section('title', 'Որոնում')
@section('content')
    <section class="pt-5">
    @if($searchResults->isEmpty() || $errors->has('q'))
        <h5 class="searchText">Ձեր հարցումով ոչինչ չի գտնվել</h5>
    @else
        <h5 class="searchText">{{'Որոնման արդյունքները «'.$searchTerm . '» հարցումով'}}</h5>
        @foreach($searchResults as $searchResult)
            <a href="{{ route('page', ['id' => $searchResult->id]) }}">
                <div class="card my-5 border-0" style="max-width: 710px;">
                    <div class="row g-0">
                        <div class="col-md-4 col-sm-4 d-flex align-items-center card_image-block">
                            <img src="{{ asset('storage/images/mainImage/' . $searchResult->main_image) }}"
                                 class="img-fluid" alt="{{ $searchResult->title }}">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ Str::limit($searchResult->title, 120, '...') }}</h5>
                                <p class="card-text card-date"><small
                                        class="text-muted">{{ \Carbon\Carbon::parse($searchResult->time_date)->isoFormat('DD MMMM Y', 'months') }}</small>
                                </p>
                                <div class="card-text text-dark card-article">{!! Str::limit($searchResult->article, 80, '...') !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    @endif
    </section>
    <div class="d-flex justify-content-center">
        {!! $searchResults->appends(request()->except('page'))->links() !!}
    </div>

@endsection
