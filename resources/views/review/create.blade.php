@extends('layouts.app')

@section("title", $data["title"])

@section('content')
<div class="container" style="padding: 15px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
            
            <div class="card-header" style="text-align: center; font-size: 25px">{{ $data["title"] }}: <b>{{$data['movie']->getTitle()}}</b></div>
            <div class="card-body">
            @if ( $errors->any() )
            <ul id="errors">
                @foreach ( $errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <form method="POST" action="{{ route('review.save') }}">
                @csrf
                <style>
                    input{
                        margin: 5px;
                        text-align: left;
                        width: 100%;
                    }
                </style>

                <input type="text" placeholder="Comment about the movie" name="opinion" style="height: 60px; width: 100%;" value="{{ old('opinion') }}" /><br>
                <input type="number" step="0.1" placeholder="Number of stars" name="stars" min="1" max="5" value="{{ old('stars') }}" /><br>
                <input type="hidden"  name="movie_id" value="{{ $data['movie']->getId() }}" /><br>
                <input type="submit" style="text-align: center" value="Publish Review" />
            </form>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
