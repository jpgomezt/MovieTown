@extends('layouts.app')

@section('title', __("movie.update_movie"))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __("movie.update_movie") }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul id="errors">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('admin.movie.saveUpdate') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="{{ __('movie.enter_title') }}" name="title"
                                    value="{{ $data['movie']->getTitle() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="{{ __('movie.enter_plot') }}" name="plot"
                                    value="{{ $data['movie']->getPlot() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" step="0.1" placeholder="{{ __('movie.enter_critics_score') }}"
                                    name="critics_score" value="{{ $data['movie']->getCriticsScore() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" step="0.01" placeholder="{{ __('movie.enter_price') }}"
                                    name="price" value="{{ $data['movie']->getPrice() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" placeholder="{{ __('movie.enter_rent_quantity') }}"
                                    name="rent_quantity" value="{{ $data['movie']->getRentQuantity() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" placeholder="{{ __('movie.enter_sell_quantity') }}"
                                    name="sell_quantity" value="{{ $data['movie']->getSellQuantity() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <label>{{ __("movie.image") }}</label>
                                <input class="form-control" type="file" name="movie_image"
                                value="{{ URL::asset('storage/' . $data['movie']->getId() . '.png') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <img class="img-thumbnail w-50" src="{{ URL::asset('storage/' . $data['movie']->getId() . '.png') }}" />
                            </div>
                            <input type="hidden" name="movie_id" value="{{ $data['movie']->getId() }}">
                            <input class="btn btn-success" type="submit" value="{{ __("movie.update") }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
