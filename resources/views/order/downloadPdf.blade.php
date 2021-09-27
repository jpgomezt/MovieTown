<!DOCTYPE html>
<head>
</head>
<body>
<br>
<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">List of orders</h2>
<br>
@if ( count($data['list']) == 0 )
    <br>
        <h4 class="page-section-body text-center">You don't have any orders in the moment</h4>
    <br>
@else
    @foreach ( $data['list'] as $order )
        <div class="container mt-4 mb-4">
            <div class="card ">
                <a href="{{ route('order.show', ['id' => $order->getId() ]) }}"><div class="card-header text-center" style="font-size: 35px;">Address: {{ $order->getAddress() }}</div></a>
                <div class="card-body">
                
        
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <b>Created By: </b><br>
                            <span style="font-size: 25px">{{ $order->user->getName() }}</span>
                            <br>
                            <b>Payment type: </b><br>
                            <span style="font-size: 25px">{{ $order->getPaymentType() }}</span>
                            <br>
                            <b>Created date: </b><br>
                            <span style="font-size: 25px">{{ $order->getDate() }}</span>
                            <br>
                            <b>Total: </b><br>
                            <span style="font-size: 25px">{{ $order->getTotal() + $order->getShippingCost() }}$</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <b>Shipping Date:</b> @if ( $order->getShippingDate() == NULL ) There is no shipping date yet @else {{ $order->getShippingDate() }} @endif<br><br>
                            <b>Shipping Cost:</b> {{ $order->getShippingCost() }}$ <br><br>
                            <b>Is Shipped:</b> @if ( $order->getIsShipped() ) This order is not shipped yet @else Your order is on the way @endif<br><br>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
</body>
