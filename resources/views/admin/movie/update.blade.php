@extends('layouts.app')

@section('title', $data['title'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update movie</div>
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
                                <input class="form-control" type="text" placeholder="Enter title" name="title"
                                    value="{{ $data['movie']->getTitle() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter plot" name="plot"
                                    value="{{ $data['movie']->getPlot() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" step="0.1" placeholder="Enter critics score"
                                    name="critics_score" value="{{ $data['movie']->getCriticsScore() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" step="0.01" placeholder="Enter price"
                                    name="price" value="{{ $data['movie']->getPrice() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" placeholder="Enter rent quantity"
                                    name="rent_quantity" value="{{ $data['movie']->getRentQuantity() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" placeholder="Enter sell quantity"
                                    name="sell_quantity" value="{{ $data['movie']->getSellQuantity() }}" />
                            </div>
                            <div class="input-group mb-3">
                                <label>Image:</label>
                                <input class="form-control" type="file" name="movie_image"
                                    value="{{ URL::asset('storage/' . $data['movie']->getId() . '.png') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <img src="{{ URL::asset('storage/' . $data['movie']->getId() . '.png') }}" />
                            </div>
                            <input type="hidden" name="movie_id" value="{{ $data['movie']->getId() }}">
                            <input class="btn btn-success" type="submit" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
