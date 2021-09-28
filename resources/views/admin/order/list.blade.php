@extends('layouts.app')

@section('title', $data['title'])

@section('content')
    <br>
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">List of orders</h2>
    <br>
        <div class="text-center">
            <form method="GET" action="{{ route('order.ordersPdf') }}">
                @csrf
                <input type="submit" class="btn btn-success" value="Download Orders">
            </form>
        </div>
    
    @if (count($data['list']) == 0)
        <br>
        <h4 class="page-section-body text-center">You don't have any orders in the moment</h4>
        <br>
    @else
        <div class="container mt-4 mb-4">
            <div class="card ">                
                <div class="card-header text-center" style="font-size: 35px;">Summary of orders</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <b>Total orders: </b><br>
                            <span style="font-size: 35px">{{ count($data['list']) }}</span>
                            <br>
                            <b>Total revenues: </b><br>
                            <span style="font-size: 35px">{{ $data['total_money'] }} $</span>
                            <br>
                            <b>Number of movies (Rented or Buyed): </b><br>
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
                        <div class="card-header text-center" style="font-size: 35px;">Address: {{ $order->getAddress() }}
                        </div>
                    </a>
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
                                <span
                                    style="font-size: 25px">{{ $order->getTotal() + $order->getShippingCost() }}$</span>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <b>Shipping Date:</b> @if ($order->getShippingDate() == null) There is no shipping date yet @else {{ $order->getShippingDate() }} @endif<br><br>
                                <b>Shipping Cost:</b> {{ $order->getShippingCost() }}$ <br><br>
                                <b>Is Shipped:</b> @if ($order->getIsShipped()) This order is not shipped yet @else Your order is on the way @endif<br><br>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
