@extends('layouts.app')

@section('title', __('review.create_review'))

@section('content')
    <div class="container" style="padding: 15px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header" style="text-align: center; font-size: 25px">
                        {{ __('review.create_review') }}: <b>{{ $data['movie']->getTitle() }}</b></div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul id="errors">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ route('admin.review.save') }}">
                            @csrf
                            <style>
                                input {
                                    margin: 5px;
                                    text-align: left;
                                    width: 100%;
                                }

                            </style>

                            <input type="text" placeholder="{{ __('review.comment_about_movie') }}" name="opinion"
                                style="height: 60px; width: 100%;" value="{{ old('opinion') }}" /><br>
                            <input type="number" step="0.1" placeholder="{{ __('review.number_of_stars') }}" name="stars"
                                min="1" max="5" value="{{ old('stars') }}" /><br>
                            <input type="hidden" name="movie_id" value="{{ $data['movie']->getId() }}" /><br>
                            <input type="submit" style="text-align: center" value="{{ __('review.create_review') }}" />
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
