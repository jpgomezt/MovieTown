@extends('layouts.app')

@section('title', __('cart.page_title'))

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card ">
            <div class="card-header text-center h1">{{ __('cart.header') }}</div>
            <div class="card-body">
                @if ($data['empty'])
                    <p class="card-text text-center">{{ __('cart.empty') }}</p>
                @else
                    @foreach ($data['movies'] as $movie)
                        <div class="col mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img class="card-img img-thumbnail"
                                        src="{{ URL::asset('storage/' . $movie->getId() . '.png') }}">
                                    <a href="{{ route('movie.show', ['id' => $movie->getId()]) }}"
                                        class="stretched-link"></a>
                                </div>
                                <div class="col-md-8 my-auto">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $movie->getTitle() }}</h5>
                                        @if ($data['products'][$movie->getId()]['rent'])
                                            <p class="card-subtitle text-muted">{{ __('cart.renting') }}</p>
                                        @else
                                            <p class="card-subtitle text-muted">{{ __('cart.buying') }}</p>
                                        @endif
                                        <p class="card-text">{{ __('cart.amount') }}
                                            {{ $data['products'][$movie->getId()]['quantity'] }}
                                        </p>
                                        <p class="card-text">{{ __('cart.item_total') }}
                                            {{ $data['products'][$movie->getId()]['itemTotal'] . __('cart.currency') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <p class="card-text">
                        {{ __('cart.subtotal') }} {{ $data['subtotal'] . __('cart.currency') }}
                    </p>
                    <p class="card-text">{{ __('cart.shipping_cost') }}</p>
                    <p class="card-text">
                        {{ __('cart.total') }} {{ $data['subtotal'] + 5.3 . __('cart.currency') }}
                    </p>
                    <a class="btn btn-danger mt-2" href="{{ route('cart.empty') }}">{{ __('cart.empty_cart') }}</a>
                    <div class="col-md-8 mt-2 pl-0">
                        <div class="card">
                            <div class="card-header" style="text-align: center; font-size: 25px">
                                {{ __('cart.checkout') }}
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <ul id="errors">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <form method="POST" action="{{ route('cart.checkout') }}">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input class="form-control" type="text"
                                            placeholder="{{ __('cart.address_form') }}" name="address"
                                            value="{{ old('address') }}" />
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="paymentForm">{{ __('cart.payment_form') }}</label>
                                        <select class="form-control" name="payment_type" id="paymentForm">
                                            <option>{{ __('cart.payment_option_1') }}</option>
                                            <option>{{ __('cart.payment_option_2') }}</option>
                                            <option>{{ __('cart.payment_option_3') }}</option>
                                            <option>{{ __('cart.payment_option_4') }}</option>
                                        </select>
                                    </div>
                                    <input class="btn btn-success mt-2" type="submit" value="Checkout">
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
