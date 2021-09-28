@extends('layouts.app')

@section('title', __('order.list_orders'))

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card ">
            <div class="card-header text-center" style="font-size: 35px;">{{ __("order.address") }} {{ $data['order']->getAddress() }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <b>{{ __("order.created_by") }} </b><br>
                        <span style="font-size: 25px">{{ $data['order']->user->getName() }}</span>
                        <br>
                        <b>{{ __("order.payment_type") }}</b><br>
                        <span style="font-size: 25px">{{ $data['order']->getPaymentType() }}</span>
                        <br>
                        <b>{{ __("order.created_date") }}</b><br>
                        <span style="font-size: 25px">{{ $data['order']->getDate() }}</span>
                        <br>
                        <b>{{ __("order.total") }}</b><br>
                        <span style="font-size: 25px">{{ $data['order']->getTotal() + $data['order']->getShippingCost() }}$</span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <b>{{ __("order.shipping_date") }}</b> @if ( $data['order']->getShippingDate() == NULL ) {{ __("order.shipping_messsage") }} @else {{ $data['order']->getShippingDate() }} @endif<br><br>
                        <b>{{ __("order.shipping_cost") }}</b> {{ $data['order']->getShippingCost() }}$ <br><br>
                        <b>{{ __("order.is_shipped") }}</b> @if ( $data['order']->getIsShipped() ) {{ __("order.is_shipped_status_positive") }} @else {{ __("order.is_shipped_status_negative") }} @endif<br><br>
                        
                        <div class="row">
                            <div class="col-sm-2">
                            @if ($data['time'])
                            <form method="POST" action="{{ route('order.delete', ['id'=>$data['order']->getId()]) }}">
                                @csrf 
                                <input type="submit" class="btn btn-danger" value="{{ __("order.cancel") }}">
                            </form>
                            @endif
                            </div>
                            <div class="col-sm-2">
                                <form method="GET" action="{{ route('item.list', ['id'=>$data['order']->getId()]) }}">
                                    @csrf 
                                    <input type="submit" class="btn btn-success" value="{{ __("order.items") }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
