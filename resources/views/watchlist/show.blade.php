@extends('layouts.app')

@section('title')
{{ $data["title"] }}
@endsection

@section('content')
<h1>{{ $data["watchlist"]->getName() }}</h1>

@if( $data["watchlist"]->movies->count() === 0 )
Your watchlist do not contain any movie - Go on create an epic one !!!
@else
<ul class="list-group">
    @foreach ($data["watchlist"]->movies as $movie)
    <li class="list-group-item list-group-item-primary"><a href="{{ route('movie.show', ['id'=>$movie->getId()]) }}">{{ $movie->getTitle() }}</a></li>
    @endforeach
</ul>
@endif

@endsection