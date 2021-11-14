@extends('layouts.app')

@section('title', __('movie.list_title'))

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header text-center h1">
                <h1>{{ __('movie.available_movies') }}</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('movie.filter') }}" enctype="multipart/form-data">
                    @csrf
                    <h5>{{ __('movie.filters') }}</h5>
                    <div class="row mb-3">
                        <div class="col m-auto">
                            <div class="d-flex">
                                <input class="form-control flex-fill" type="text"
                                    placeholder="{{ __('movie.title_filter') }}" name="title">
                            </div>
                        </div>
                        <div class="col m-auto">
                            <div class="d-flex flex-column">
                                <label class="flex-fill text-center"
                                    for="criticsScoreRange">{{ __('movie.critics_score') }}</label>
                                <input type="range" class="custom-range flex-fill" name="score" min="0" max="5" step="0.1"
                                    id="criticsScoreRange">
                                <span class="flex-fill text-center" id="score_value"></span>
                            </div>
                        </div>
                        <div class="col m-auto">
                            <input class="form-control flex-fill" type="text" placeholder="{{ __('movie.price_filter') }}"
                                name="price" value="">
                        </div>
                        <div class="col m-auto">
                            <div class="d-flex flex-column custom-control custom-switch">
                                <input class="flex-fill custom-control-input" type="checkbox" name="rent" id="rentSwitch">
                                <label class="flex-fill custom-control-label" for="rentSwitch">
                                    {{ __('movie.rent_filter') }}
                                </label>
                            </div>
                        </div>
                        <div class="col m-auto">
                            <input class="btn btn-primary ms-4" type="submit" value="{{ __('movie.filter') }}">
                            <a class="btn btn-primary" href=" {{ route('movie.list') }} "
                                role="button">{{ __('movie.see_all') }}</a>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($data['movies'] as $movie)
                        <div class="col mb-4">
                            <div class="card text-center h-100" style="width: 18rem;">
                                <h5 class="card-header">{{ $movie->getTitle() }}</h5>
                                <img src="{{ URL::asset('storage/' . $movie->getId() . '.png') }}"
                                    class="card-img-top text-center img-thumbnail">
                                <div class="card-body d-flex flex-column">
                                    @if (strlen($movie->getPlot()) > 70)
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            {{ substr($movie->getPlot(), 0, 70) }}...
                                        </h6>
                                    @else
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $movie->getPlot() }}</h6>
                                    @endif
                                </div>
                                <a href="{{ route('movie.show', ['id' => $movie->getId()]) }}"
                                    class="stretched-link"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        var slider = document.getElementById("criticsScoreRange");
        var output = document.getElementById("score_value");
        output.innerHTML = slider.value;

        slider.oninput = function() {
            output.innerHTML = this.value;
        }
    </script>
@endsection
