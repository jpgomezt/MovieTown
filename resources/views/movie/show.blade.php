@extends('layouts.app')

@section('title', $data['movie']->getTitle())

@section('content')
    <div class="container mt-4 mb-4">
        @include('util.message')
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
                        <h5 class="card-subtitle">{{ __('movie.plot') }}</h5>
                        <p class="card-text">{{ $data['movie']->getPlot() }}</p>
                        <h5 class="card-subtitle mt-1">{{ __('movie.critics_score') }}</h5>
                        <div class="card-group card-text divider-custom-line mb-3">
                            @for ($i = 0; $i < round($data['movie']->getCriticsScore()); $i++)
                                <div class="divider-custom-icon"><i class="fas fa-star text-warning"></i></div>
                            @endfor
                            <p class="card-text pl-2"> {{ $data['movie']->getCriticsScore() }}/5</p>
                        </div>
                        <h5 class="card-subtitle mt-1">{{ __('movie.sell_quantity') }}</h5>
                        <p class="card-text"> {{ $data['movie']->getSellQuantity() }}</p>
                        <h5 class="card-subtitle mt-1">{{ __('movie.sell_price') }}</h5>
                        <p class="card-text"> {{ $data['movie']->getPrice() }}$</p>
                        <h5 class="card-subtitle mt-1">{{ __('movie.rent_quantity') }}</h5>
                        <p class="card-text"> {{ $data['movie']->getRentQuantity() }}</p>
                        <h5 class="card-subtitle mt-1">{{ __('movie.rent_price') }}</h5>
                        <p class="card-text"> {{ $data['movie']->getPrice() * 0.2 }}$</p>
                        <!-- Movie Reviews-->
                        <hr>
                        <h3>{{ __('movie.reviews') }}</h3>
                        <ul class="list-group">
                            @foreach ($data['movie']->reviews as $review)
                                @if ($review->getIsVisible())
                                    <li class="list-group-item pb-3 pt-3">
                                        <h5 class="card-title">{{ __('movie.review_by') }}
                                            {{ $review->user->getName() }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"> {{ $review->getDate() }} </h6>
                                        <div class="card-group card-text divider-custom-line">
                                            @for ($i = 0; $i < round($review->getStars()); $i++)
                                                <div class="divider-custom-icon"><i class="fas fa-star text-warning"></i>
                                                </div>
                                            @endfor
                                            <p class="card-text pl-2"> {{ $review->getStars() }}/5</p>
                                        </div>
                                        <p class="card-text"> {{ $review->getOpinion() }}</p>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <!-- Movie Buttons for Login Users-->
                        @guest
                        @else
                            <hr>
                            <ul class="list-group list-group-horizontal justify-content-center">
                                <li class="list-group-item">
                                    <div class="form-group">
                                        <label class="h6" for="exampleFormControlSelect1">
                                            {{ __('movie.add_to_cart') }} <i class="fas fa-shopping-cart"></i>
                                        </label>
                                        <form method="POST" action="{{ route('cart.add') }}">
                                            @csrf
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" name="rent" id="rentSwitch">
                                                <label class="custom-control-label" for="rentSwitch">
                                                    {{ __('movie.are_you_renting') }}
                                                </label>
                                            </div>
                                            <input class="form-control mt-2" type="number"
                                                placeholder="{{ __('movie.enter_quantity') }}" name="quantity">
                                            <input type="hidden" name="movie_id" value="{{ $data['movie']->getId() }}">
                                            <input class="btn btn-warning mt-2" type="submit"
                                                value="{{ __('movie.add_to_cart') }}">
                                        </form>
                                    </div>
                                </li>
                                @if ($data['watchlists']->count() > 0)
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label class="h6" for="exampleFormControlSelect1">
                                                {{ __('movie.add_to_watchlist') }}
                                            </label>
                                            <form method="POST" action="{{ route('watchlist.addMovie') }}">
                                                @csrf
                                                <select class="form-control mt-2" id="exampleFormControlSelect1"
                                                    name="watchlist_id">
                                                    @foreach ($data['watchlists'] as $watchlist)
                                                        <option value="{{ $watchlist->getId() }}">
                                                            {{ $watchlist->getName() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="movie_id" value="{{ $data['movie']->getId() }}">
                                                <input class="btn btn-danger mt-2" type="submit"
                                                    value="{{ __('movie.add_to_watchlist') }}">
                                            </form>
                                        </div>
                                    </li>
                                @endif
                                <li class="list-group-item ">
                                    <label class="h6">{{ __('movie.create_review') }}</label>
                                    <form method="POST"
                                        action="{{ route('review.create', ['id' => $data['movie']->getId()]) }}">
                                        @csrf
                                        <input class="btn btn-success mt-2" type="submit"
                                            value="{{ __('movie.review_button') }}">
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
