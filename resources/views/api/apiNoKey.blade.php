@extends('layouts.app')
@section('content')
    <section class="page-section cartparts" id="cartparts-list">
        <div class="justify-content-cente container mt-5">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0"> {{ __('api.title') }} </h2>
            <table border=\"0\">
                <thead>
                    <tr>
                        <th> {{ __('api.item_name') }}</th>
                        <th> {{ __('api.item_model') }}</th>
                        <th> {{ __('api.item_category') }}</th>
                        <th> {{ __('api.item_brand') }}</th>
                        <th> {{ __('api.item_stock') }}</th>
                        <th> {{ __('api.item_price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['api'] as $item)
                        <tr>
                            <td> {{ $item->name }} </td>
                            <td> {{ $item->model }} </td>
                            <td> {{ $item->category }} </td>
                            <td> {{ $item->brand }} </td>
                            <td> {{ $item->stock }} </td>
                            <td> {{ $item->price }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
