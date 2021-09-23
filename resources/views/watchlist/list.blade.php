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
    <li class="list-group-item list-group-item-primary"><a href="{{ route('watchlist.show', ['id'=>$watchlist->getId()]) }}">{{ $watchlist->getName() }}</a> 
    <form style="all:initial;" action="{{ route('watchlist.delete', ['id'=>$watchlist->getId()]) }}" method="post">
        @csrf
        <input type="submit" value="Delete">
    </form>
    </li>
    @endforeach
</ul>
@endif
<br />
<a class="btn btn-primary" href="{{ route('watchlist.create') }}" role="button">New watchlist</a>

@endsection