@extends('layouts.app')

@section('title', $data['title'])

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card ">
            <div class="card-header text-center" style="font-size: 35px;">Address: {{ $data['order']->getAddress() }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <b>Created By: </b><br>
                        <span style="font-size: 25px">{{ $data['order']->user->getName() }}</span>
                        <br>
                        <b>Payment type: </b><br>
                        <span style="font-size: 25px">{{ $data['order']->getPaymentType() }}</span>
                        <br>
                        <b>Created date: </b><br>
                        <span style="font-size: 25px">{{ $data['order']->getDate() }}</span>
                        <br>
                        <b>Total: </b><br>
                        <span style="font-size: 25px">{{ $data['order']->getTotal() + $data['order']->getShippingCost() }}$</span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <b>Shipping Date:</b> @if ( $data['order']->getShippingDate() == NULL ) There is no shipping date yet @else {{ $data['order']->getShippingDate() }} @endif<br><br>
                        <b>Shipping Cost:</b> {{ $data['order']->getShippingCost() }}$ <br><br>
                        <b>Is Shipped:</b> @if ( $data['order']->getIsShipped() ) This order is not shipped yet @else Your order is on the way @endif<br><br>
                        
                        <div class="row">
                            <div class="col-sm-2">
                            <form method="POST" action="{{ route('order.delete', ['id'=>$data['order']->getId()]) }}">
                                @csrf 
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                            </div>
                            <div class="col-sm-2">
                            <form method="GET" action="{{ route('order.update', ['id'=>$data['order']->getId()]) }}">
                                @csrf 
                                <input type="submit" class="btn btn-info" value="Update">
                            </form>
                            </div>
                            <div class="col-sm-2">
                                <form method="GET" action="{{ route('item.list', ['id'=>$data['order']->getId()]) }}">
                                    @csrf 
                                    <input type="submit" class="btn btn-success" value="Items">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

