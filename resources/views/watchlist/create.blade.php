@extends('layouts.app')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $data['title'] }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul id="errors">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('watchlist.save') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter name" name="name"
                                    value="{{ old('name') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Enter description" name="description"
                                    value="{{ old('description') }}" />
                            </div>
                            <input class="btn btn-success" type="submit" value="Create">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
