@extends('layouts.app')
@section('content')
    <section class="page-section cartparts" id="cartparts-list">
        <div class="justify-content-cente container mt-5">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Products</h2>
            <table border=\"0\">
                <thead>
                    <tr>
                        <th> Name</th>
                        <th> Model</th>
                        <th> Category</th>
                        <th> Brand</th>
                        <th> Stock</th>
                        <th> Price</th>
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
