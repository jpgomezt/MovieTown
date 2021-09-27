@extends('layouts.app')

@section('title')
    {{ __("watchlist.list_title") }}
@endsection

@section('content')
    <div class="container mt-4 mb-4" >
        <div class="card">
            <div class="card-header h1 text-center">{{ __("watchlist.list_title") }}</div>
            <div class="card-body">
                @if ($data['watchlists']->count() === 0)
                    <p class="card-text text-center">{{ __("watchlist.zero_watchlist_message") }}</p>
                @else

                    @foreach ($data['watchlists'] as $watchlist)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title"><a
                                        href="{{ route('watchlist.show', ['id' => $watchlist->getId()]) }}">{{ $watchlist->getName() }}</a>
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $watchlist->getDescription() }}</h6>
                                <form action="{{ route('watchlist.delete', ['id' => $watchlist->getId()]) }} "
                                    method="post">
                                    @csrf
                                    <input class="btn btn-danger" type="submit" value="{{ __("watchlist.delete_button") }}">
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="text-center">
                    <a class="btn btn-primary card-link mt-4" href="{{ route('watchlist.create') }}" role="button">
                        {{ __("watchlist.add_watchlist") }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
