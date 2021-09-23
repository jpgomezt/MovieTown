@extends('layouts.app')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')

    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header text-center h1">
                <h1>{{ $data['watchlist']->getName() }}</h1>
                <h5>{{ $data['watchlist']->getDescription() }}</h5>
            </div>
            <!--<div class="card-header h1 text-center">{{ $data['watchlist']->getName() }}</div>-->
            <div class="card-body">
                @if ($data['watchlist']->movies()->count() === 0)
                    <p class="card-text text-center">Your watchlist do not contain any movie - Go on and create an epic one!!!</p>
                @else

                    @foreach ($data['watchlist']->movies as $movie)
                        <div class="card" style="width: 18rem;">
                            <img src="{{ URL::asset('storage/' . $movie->getId() . '.png') }}" class="card-img-top text-center" alt="{{ $movie->getTitle() }} - Image">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('movie.show', ['id' => $movie->getId()]) }}">{{ $movie->getTitle() }}</a>
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $movie->getPlot() }}</h6>
                                <form action="{{ route('watchlist.removeMovie', ['id' => $movie->getId()]) }} " method="post">
                                    @csrf
                                    <input type="hidden" name="watchlist_id" value="{{ $data['watchlist']->getId() }}">
                                    <input type="submit" value="Delete">
                                </form>
                                <!-- <a href="#" class="card-link">Delete</a> -->
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="text-center">
                    <a class="btn btn-primary card-link mt-4" href="{{ route('movie.list') }}" role="button">
                        Add movies
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
