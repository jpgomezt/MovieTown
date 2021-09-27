@extends('layouts.app')

@section('title')
    {{ __('watchlist.create_title') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('watchlist.create_title') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul id="errors">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('admin.watchlist.save') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="{{ __('watchlist.name_input') }}"
                                    name="name" value="{{ old('name') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="text"
                                    placeholder="{{ __('watchlist.description_input') }}" name="description"
                                    value="{{ old('description') }}" />
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"
                                        for="selectUser">{{ __('watchlist.select_user') }}</label>
                                </div>
                                <select class="form-control" id="selectUser" name="user_id">
                                    @foreach ($data['users'] as $user)
                                        <option value="{{ $user->getId() }}">{{ $user->getEmail() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="btn btn-success" type="submit" value="{{ __('watchlist.create_button') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
