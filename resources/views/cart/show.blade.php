@extends('layouts.app')

@section('title', $data['title'])

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card ">
            <div class="card-header text-center h1">Cart</div>
            <div class="card-body">
                @if ($data['empty'])
                    <p class="card-text text-center">You currently do not have any products - Go on and add them !!!.</p>
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
                                            <p class="card-subtitle text-muted">Renting</p>
                                        @else
                                            <p class="card-subtitle text-muted">Buying</p>
                                        @endif
                                        <p class="card-text">Amount:
                                            {{ $data['products'][$movie->getId()]['quantity'] }}
                                        </p>
                                        <p class="card-text">Item Total:
                                            {{ $data['products'][$movie->getId()]['itemTotal'] }}$
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <p class="card-text">Subtotal: {{ $data['subtotal'] }}$</p>
                    <p class="card-text">ShippingCost: 5.30$</p>
                    <p class="card-text">Total: {{ $data['subtotal'] + 5.30 }}$</p>
                    <a class="btn btn-danger mt-2" href="{{ route('cart.empty') }}">Empty cart</a>
                    <div class="col-md-8 mt-2 pl-0">
                        <div class="card">
                            <div class="card-header" style="text-align: center; font-size: 25px">
                                Checkout
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
                                        <input class="form-control" type="text" placeholder="Enter address" name="address"
                                            value="{{ old('address') }}" />
                                    </div>
                                    <div class="input-group mb-3">
                                        <input class="form-control" type="text" placeholder="Enter payment type"
                                            name="payment_type" value="{{ old('payment_type') }}" />
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
