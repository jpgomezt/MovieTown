@extends('layouts.app')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header h1 text-center">Your Watchlists</div>
            <div class="card-body">
                @if ($data['watchlists']->count() === 0)
                    <p class="card-text text-center">You currently do not have any watchlist - Go on and create one !!!.</p>
                @else

                    @foreach ($data['watchlists'] as $watchlist)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><a
                                        href="{{ route('watchlist.show', ['id' => $watchlist->getId()]) }}">{{ $watchlist->getName() }}</a>
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $watchlist->getDescription() }}</h6>
                                <form action="{{ route('watchlist.delete', ['id' => $watchlist->getId()]) }} "
                                    method="post">
                                    @csrf
                                    <input type="submit" value="Delete">
                                </form>
                                <!-- <a href="#" class="card-link">Delete</a> -->
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="text-center">
                    <a class="btn btn-primary card-link mt-4" href="{{ route('watchlist.create') }}" role="button">
                        New watchlist
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
