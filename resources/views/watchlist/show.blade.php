@extends('layouts.app')

@section('title')
{{ $data["title"] }}
@endsection

@section('content')
<h1>{{ $data["watchlist"]->getName() }}</h1>
<p>{{ $data["watchlist"]->getDescription() }}</p>

@if ( $data["watchlist"]->movies->count() === 0 )
Your watchlist do not contain any movie - Go on and create an epic one !!!
@else
<ul class="list-group">
    @foreach ($data["watchlist"]->movies as $movie)
    <li class="list-group-item list-group-item-primary"><a href="{{ route('movie.show', ['id'=>$movie->getId()]) }}">{{ $movie->getTitle() }}</a>
        <form style="all:initial;" action="{{ route('watchlist.removeMovie', ['id'=>$movie->getId()]) }}" 
        method="get">
            @csrf
            <input type="hidden" name="watchlist_id" value="{{ $data["watchlist"]->getId() }}">
            <input type="submit" value="Delete from watchlist">
        </form>
    </li>
    @endforeach
</ul>
@endif
<br />
<a class="btn btn-primary" href="{{ route('movie.list') }}" role="button">Add movies</a>

@endsection
