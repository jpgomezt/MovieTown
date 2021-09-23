@extends('layouts.app')

@section('title')
{{ $data["title"] }}
@endsection

@section('content')
<h1>Your Watchlists</h1>
@if( $data["watchlists"]->count() === 0 )
You currently do not have any watchlist - Go on and create one !!!

@else
<ul class="list-group">
    @foreach ($data["watchlists"] as $watchlist)
    <li class="list-group-item list-group-item-primary"><a href="{{ route('watchlist.show', ['id'=>$watchlist->getId()]) }}">{{ $watchlist->getName() }}</a></li>
    @endforeach
</ul>
@endif

@endsection