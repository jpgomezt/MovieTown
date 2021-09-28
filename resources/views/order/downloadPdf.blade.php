<!DOCTYPE html>
<head>
</head>
<body>
<br>
<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{ __("order.list_orders") }}</h2>
<br>
@if ( count($data['list']) == 0 )
    <br>
        <h4 class="page-section-body text-center">{{ __("order.no_orders") }}</h4>
    <br>
@else
    @foreach ( $data['list'] as $order )
        <div class="container mt-4 mb-4">
            <div class="card ">
                <a href="{{ route('order.show', ['id' => $order->getId() ]) }}"><div class="card-header text-center" style="font-size: 35px;">{{ __("order.address") }} {{ $order->getAddress() }}</div></a>
                <div class="card-body">
                
        
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <b>{{ __("order.created_by") }} </b><br>
                            <span style="font-size: 25px">{{ $order->user->getName() }}</span>
                            <br>
                            <b>{{ __("order.payment_type") }}</b><br>
                            <span style="font-size: 25px">{{ $order->getPaymentType() }}</span>
                            <br>
                            <b>{{ __("order.created_date") }}</b><br>
                            <span style="font-size: 25px">{{ $order->getDate() }}</span>
                            <br>
                            <b>{{ __("order.total") }}</b><br>
                            <span style="font-size: 25px">{{ $order->getTotal() + $order->getShippingCost() }}$</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <b>{{ __("order.shipping_date") }}</b> @if ( $order->getShippingDate() == NULL ) There is no shipping date yet @else {{ $order->getShippingDate() }} @endif<br><br>
                            <b>{{ __("order.shipping_cost") }}</b> {{ $order->getShippingCost() }}$ <br><br>
                            <b>{{ __("order.is_shipped") }}</b> @if ( $order->getIsShipped() ) This order is not shipped yet @else Your order is on the way @endif<br><br>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
</body>
