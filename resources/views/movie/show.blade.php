@extends('layouts.app')

@section('title', $data['movie']->getTitle())

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card ">
            <div class="card-header text-center h1">{{ $data['movie']->getTitle() }}</div>
            <div class="card-body">
                <div class="row">
                    <!-- Movie Image-->
                    <div class="col-md-6 col-sm-12">
                        <img class="card-img" src="{{ URL::asset('storage/' . $data['movie']->getId() . '.png') }}">
                    </div>
                    <!-- Movie Content-->
                    <div class="col-md-6 col-sm-12">
                        <!-- Movie Elements-->
                        <h5 class="card-subtitle">Plot</h5>
                        <p class="card-text">{{ $data['movie']->getPlot() }}</p>
                        <h5 class="card-subtitle mt-1">Critics Score</h5>
                        <div class="card-group card-text divider-custom-line mb-3">
                            @for ($i = 0; $i < round($data['movie']->getCriticsScore()); $i++)
                                <div class="divider-custom-icon"><i class="fas fa-star text-warning"></i></div>
                            @endfor
                            <p class="card-text pl-2"> {{ $data['movie']->getCriticsScore() }}/5</p>
                        </div>
                        <h5 class="card-subtitle mt-1">Rent Quantity</h5>
                        <p class="card-text"> {{ $data['movie']->getRentQuantity() }}</p>
                        <h5 class="card-subtitle mt-1">Sell Quantity</h5>
                        <p class="card-text"> {{ $data['movie']->getSellQuantity() }}</p>
                        <!-- Movie Reviews-->
                        <hr>
                        <h3>Reviews</h3>
                        <ul class="list-group">
                            @foreach ($data['movie']->reviews as $review)
                                <li class="list-group-item pb-3 pt-3">
                                    <h5 class="card-title">Review by {{ $review->user->getName() }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted"> {{ $review->getDate() }} </h6>
                                    <div class="card-group card-text divider-custom-line">
                                        @for ($i = 0; $i < round($review->getStars()); $i++)
                                            <div class="divider-custom-icon"><i class="fas fa-star text-warning"></i></div>
                                        @endfor
                                        <p class="card-text pl-2"> {{ $review->getStars() }}/5</p>
                                    </div>
                                    <p class="card-text"> {{ $review->getOpinion() }}</p>
                                </li>
                            @endforeach
                        </ul>
                        <!-- Movie Buttons for Login Users-->
                        @guest
                        @else
                            <hr>
                            <ul class="list-group list-group-horizontal justify-content-center">
                                <li class="list-group-item">
                                    <div class="form-group">
                                        <label class="h6">Add To Watchlist</label>
                                        <form method="POST" action="{{ route('cart.add') }}">
                                            @csrf
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                @for ($i = 1; $i <= $data['movie']->getSellQuantity(); $i++)
                                                    <option>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </form>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group">
                                        <label class="h6" for="exampleFormControlSelect1">Add To Watchlist</label>
                                        <form method="POST" action="{{ route('watchlist.addMovie') }}">
                                            @csrf
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                @foreach ($data['watchlists'] as $watchlist)
                                                    <option>{{ $watchlist->getName() }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                </li>
                                <li class="list-group-item ">
                                    <label class="h6">Create Review</label>
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
