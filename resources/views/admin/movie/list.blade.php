@extends('layouts.app')

@section('title', $data['title'])

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header text-center h1">
                <h1>Actual Movies</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('movie.filter') }}" enctype="multipart/form-data">
                    @csrf
                    <h5>Filters</h5>
                    <div class="row mb-3">
                        <div class="col m-auto">
                            <div class="d-flex">
                                <input class="form-control flex-fill" type="text" placeholder="Enter title" name="title">
                            </div>
                        </div>
                        <div class="col m-auto">
                            <div class="d-flex flex-column">
                                <label class="flex-fill text-center" for="criticsScoreRange">Critics Score</label>
                                <input type="range" class="custom-range flex-fill" name="score" min="0" max="5" step="0.1"
                                    id="criticsScoreRange">
                                <span class="flex-fill text-center" id="score_value"></span>
                            </div>
                        </div>
                        <div class="col m-auto">
                            <input class="form-control flex-fill" type="text" placeholder="Enter price" name="price"
                                value="">
                        </div>
                        <div class="col m-auto">
                            <div class="d-flex flex-column custom-control custom-switch">
                                <input class="flex-fill custom-control-input" type="checkbox" name="rent" id="rentSwitch">
                                <label class="flex-fill custom-control-label" for="rentSwitch">
                                    Available for Rent
                                </label>
                            </div>
                        </div>
                        <div class="col m-auto text-center">
                            <form>
                                <div style="margin: 5px 0px;">
                                <input class="btn btn-primary ms-4" type="submit" value="Filter Movies">
                                </div>
                                
                                <div style="margin: 5px 0px;">
                                <a class="btn btn-primary" href=" {{ route('movie.list') }} " role="button">All movies</a>
                                </div>
                                
                                <div style="margin: 5px 0px;">
                                <a class="btn btn-primary" href=" {{ route('movie.create') }} " role="button">Add new movie</a>
                                </div>

                            </form>

                        </div>

                    </div>

                </form>


                <hr>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($data['movies'] as $movie)
                        <div class="col mb-4">
                            <div class="card h-100" style="width: 18rem;">
                                <ul class="list-group list-group-flush d-flex">

                                    <li class="list-group-item  text-center">
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
                                    </li>
                                    <li class="list-group-item mt-auto mb-auto">
                                        <div class="row text-center">
                                            <div class="col-sm-6">
                                                <form method="POST"
                                                    action="{{ route('movie.delete', ['id' => $movie->getid()]) }}">
                                                    @csrf
                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <form method="GET" action="#">
                                                    @csrf
                                                    <input type="submit" class="btn btn-info" value="Update">
                                                </form>
                                            </div>
                                        </div>

                                    </li>
                                </ul>

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
