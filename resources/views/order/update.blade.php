@extends('layouts.app')

@section("title", $data["title"])

@section('content')
<div class="container" style="padding: 15px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
            
            <div class="card-header" style="text-align: center; font-size: 25px">{{ $data["title"] }}</div>
            <div class="card-body">
            @if ( $errors->any() )
            <ul id="errors">
                @foreach ( $errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <form method="POST" action="{{ route('order.updateProcess' , ['id' => $data['order']->getId() ]) }}">
                @csrf
                <style>
                    input{
                        margin: 5px;
                        text-align: left;
                        width: 100%;
                    }
                </style>

                <input type="text" placeholder="address" name="address" style="height: 60px; width: 100%;" value="{{ $data['order']->getAddress() }}" /><br>
                <input type="text" placeholder="payment_type" name="payment_type" style="height: 60px; width: 100%;" value="{{ $data['order']->getPaymentType() }}" /><br>
                <input type="hidden"  name="movie_id" value="" /><br>
                <input type="submit" style="text-align: center" value="{{ $data["title"] }}" />
            </form>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
