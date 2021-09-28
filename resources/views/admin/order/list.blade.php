@extends('layouts.app')

@section('title',  __('order.list_orders'))

@section('content')
    <br>
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{ __("order.list_orders") }}</h2>
    <br>
        <div class="text-center">
            <form method="GET" action="{{ route('order.ordersPdf') }}">
                @csrf
                <input type="submit" class="btn btn-success" value="{{ __("order.download_order") }}">
            </form>
        </div>
    
    @if (count($data['list']) == 0)
        <br>
        <h4 class="page-section-body text-center">{{ __("order.no_orders") }}</h4>
        <br>
    @else
        <div class="container mt-4 mb-4">
            <div class="card ">                
                <div class="card-header text-center" style="font-size: 35px;">{{ __("order.summary_orders") }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <b>{{ __("order.total_orders") }} </b><br>
                            <span style="font-size: 35px">{{ count($data['list']) }}</span>
                            <br>
                            <b>{{ __("order.total_revenues") }}</b><br>
                            <span style="font-size: 35px">{{ $data['total_money'] }} $</span>
                            <br>
                            <b>{{ __("order.rented") }}</b><br>
                            <span style="font-size: 35px">{{ $data['total_movies'] }}</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($data['list'] as $order)
            <div class="container mt-4 mb-4">
                <div class="card ">
                    <a href="{{ route('admin.order.show', ['id' => $order->getId()]) }}">
                        <div class="card-header text-center" style="font-size: 35px;">{{ __("order.address") }} {{ $order->getAddress() }}
                        </div>
                    </a>
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <b>{{ __("order.created_by") }} </b><br>
                                <span style="font-size: 25px">{{ $order->user->getName() }}</span>
                                <br>
                                <b>{{ __("order.payment_type") }} </b><br>
                                <span style="font-size: 25px">{{ $order->getPaymentType() }}</span>
                                <br>
                                <b>{{ __("order.created_date") }} </b><br>
                                <span style="font-size: 25px">{{ $order->getDate() }}</span>
                                <br>
                                <b>{{ __("order.total") }} </b><br>
                                <span
                                    style="font-size: 25px">{{ $order->getTotal() + $order->getShippingCost() }}$</span>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <b>{{ __("order.shipping_date") }}</b> @if ($order->getShippingDate() == null) {{ __("order.shipping_messsage") }} @else {{ $order->getShippingDate() }} @endif<br><br>
                                <b>{{ __("order.shipping_cost") }}</b> {{ $order->getShippingCost() }}$ <br><br>
                                <b>{{ __("order.is_shipped") }}</b> @if ($order->getIsShipped()) {{ __("order.is_shipped_status_positive") }}  @else {{ __("order.is_shipped_status_negative") }} @endif<br><br>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
