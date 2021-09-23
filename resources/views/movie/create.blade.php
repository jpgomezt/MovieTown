@extends('layouts.app')

@section('title', $data['title'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create movie</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul id="errors">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('movie.save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter title" name="title"
                                    value="{{ old('title') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter plot" name="plot"
                                    value="{{ old('plot') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter critics score"
                                    name="critics_score" value="{{ old('critics_score') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter price" name="price"
                                    value="{{ old('price') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter rent quantity"
                                    name="rent_quantity" value="{{ old('rent_quantity') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter sell quantity"
                                    name="sell_quantity" value="{{ old('sell_quantity') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <label>Image:</label>
                                <input class="form-control" type="file" name="movie_image" />
                            </div>
                            <input class="btn btn-success" type="submit" value="Create">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
