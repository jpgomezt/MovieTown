@extends('layouts.app')

@section('title', $data['title'])

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header text-center h1">
                <h1>Items</h1>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($data['order']->items as $item)
                        <div class="col mb-4">
                            <div class="card text-center h-100" style="width: 18rem;">
                                <h5 class="card-header">{{ $item->movie->getTitle() }}</h5>
                                <img src="{{ URL::asset('storage/' . $item->movie->getId() . '.png') }}"
                                    class="card-img-top text-center img-thumbnail">
                                <div class="card-body d-flex flex-column">
                                    @if ($item->getIsRented())
                                        <h6 class="card-subtitle mb-2 text-muted">Renting</h6>
                                    @else
                                        <h6 class="card-subtitle mb-2 text-muted">Buying</h6>
                                    @endif
                                    <p class="card-text mb-2">Amount: {{ $item->getQuantity() }}</p>
                                    <p class="card-text">Item Total:
                                        {{ $item->getSubtotal() }}$
                                    </p>
                                </div>
                                <a href="{{ route('movie.show', ['id' => $item->movie->getId()]) }}"
                                    class="stretched-link"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
