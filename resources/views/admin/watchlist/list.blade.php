@extends('layouts.app')

@section('title')
    {{ __('watchlist.admin_list_title') }}
@endsection

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header h1 text-center">{{ __('watchlist.admin_list_title') }}</div>
            <div class="card-body">

                @foreach ($data['users'] as $user)
                <div class="card mb-2 mt-2">
                    <div class="card-header"><b>{{ __('watchlist.owner_message') }}</b> {{ $user->getName() }}</div>

                    @if ($user->watchlists->count() === 0)
                            <div class="card-body"><b>{{ __("watchlist.owner_no_watchlist") }}</b></div>
                    @else

                            @foreach ($user->watchlists as $watchlist)
                                <div class="card mb-2 mt-2">
                                    <div class="card-body">
                                        <h5 class="card-title"><a
                                                href="{{ route('admin.watchlist.show', ['id' => $watchlist->getId()]) }}">{{ $watchlist->getName() }}</a>
                                        </h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $watchlist->getDescription() }}</h6>
                                        <form
                                            action="{{ route('admin.watchlist.delete', ['id' => $watchlist->getId()]) }} "
                                            method="post">
                                            @csrf
                                            <input class="btn btn-danger" type="submit" value="{{ __("watchlist.delete_button") }}">
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                    @endif
                    </div>
                @endforeach
                <div class="text-center">
                    <a class="btn btn-primary card-link mt-4" href="{{ route('admin.watchlist.create') }}" role="button">
                        {{ __("watchlist.add_watchlist") }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
