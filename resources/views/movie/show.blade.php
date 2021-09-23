@extends('layouts.app')

@section('title', $data['movie']->getTitle())

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card ">
            <div class="card-header text-center">{{ $data['movie']->getTitle() }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <img class="card-img" src="{{ URL::asset('storage/' . $data['movie']->getId() . '.png') }}">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <b>Movie title:</b> {{ $data['movie']->getTitle() }}<br><br>
                        <b>Movie Price:</b> ${{ $data['movie']->getPrice() }}<br><br>
                        <b>Movie Plot:</b> {{ $data['movie']->getPlot() }}<br><br>
                        <b>Movie Critics Score:</b> {{ $data['movie']->getCriticsScore() }}<br><br>
                        <b>Movie Rent Quantity:</b> {{ $data['movie']->getRentQuantity() }}<br><br>
                        <b>Movie Sell Quantity:</b> {{ $data['movie']->getSellQuantity() }}<br><br>
                        @foreach ($data['movie']->reviews as $review)
                            <b>Prueba</b>
                            <b>Review by </b> {{ $review->user->getName() }}<br><br>
                            <b> {{ $review->getOpinion() }}</b><br><br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
