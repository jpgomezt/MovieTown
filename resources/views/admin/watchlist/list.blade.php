@extends('layouts.app')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header h1 text-center">All Watchlists</div>
            <div class="card-body">

                @foreach ($data['users'] as $user)
                    @if ($user->watchlists->count() === 0)
                        <div class="card mb-2 mt-2">
                            <div class="card-header">Watchlists owner: {{ $user->getName() }}</div>
                            <div class="card-body"><b>This user currently does not own any watchlist</b></div>
                        </div>
                    @else
                        <div class="card">

                            <div class="card-header">Watchlists owner: {{ $user->getName() }}</div>
                            @foreach ($user->watchlists as $watchlist)
                                <div class="card mb-2 mt-2">
                                    <div class="card-body">
                                        <h5 class="card-title"><a
                                                href="{{ route('admin.watchlist.show', ['id' => $watchlist->getId()]) }}">{{ $watchlist->getName() }}</a>
                                        </h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $watchlist->getDescription() }}</h6>
                                        <form action="{{ route('admin.watchlist.delete', ['id' => $watchlist->getId()]) }} "
                                            method="post">
                                            @csrf
                                            <input class="btn btn-danger" type="submit" value="Delete">
                                        </form>
                                        <!-- <a href="#" class="card-link">Delete</a> -->
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                @endforeach
                <div class="text-center">
                    <a class="btn btn-primary card-link mt-4" href="{{ route('admin.watchlist.create') }}" role="button">
                        New watchlist
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
