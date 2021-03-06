@extends('layouts.app')

@section('title', __('movie.create_movie'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('movie.create_movie') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul id="errors">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('admin.movie.save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="{{ __('movie.enter_title') }}"
                                    name="title" value="{{ old('title') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="{{ __('movie.enter_plot') }}"
                                    name="plot" value="{{ old('plot') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" step="0.1"
                                    placeholder="{{ __('movie.enter_critics_score') }}" name="critics_score"
                                    value="{{ old('critics_score') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" step="0.01"
                                    placeholder="{{ __('movie.enter_price') }}" name="price"
                                    value="{{ old('price') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number"
                                    placeholder="{{ __('movie.enter_rent_quantity') }}" name="rent_quantity"
                                    value="{{ old('rent_quantity') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number"
                                    placeholder="{{ __('movie.enter_sell_quantity') }}" name="sell_quantity"
                                    value="{{ old('sell_quantity') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <label>{{ __('movie.image') }}</label>
                                <input class="form-control" type="file" name="movie_image" required />
                            </div>
                            <input class="btn btn-success" type="submit" value="{{ __('movie.create') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
