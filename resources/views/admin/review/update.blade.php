@extends('layouts.app')

@section('title', $data['title'])

@section('content')
    <div class="container" style="padding: 15px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header" style="text-align: center; font-size: 25px">{{ $data['title'] }}:
                        <b>{{ $data['review']->movie->getTitle() }}</b>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul id="errors">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST"
                            action="{{ route('admin.review.updateProcess', ['id' => $data['review']->getId()]) }}">
                            @csrf
                            <style>
                                input {
                                    margin: 5px;
                                    text-align: left;
                                    width: 100%;
                                }

                            </style>

                            <input type="text" placeholder="Comment about the movie" name="opinion"
                                style="height: 60px; width: 100%;" value="{{ $data['review']->getOpinion() }}" /><br>
                            <input type="number" step="0.1" placeholder="Number of stars" name="stars" min="1" max="5"
                                value="{{ $data['review']->getStars() }}" /><br>
                            <label for="is_visible">Make the comment visible:</label>
                            <select name="is_visible" id=="is_visible">
                                <option value="1" @if ($data['review']->getIsVisible()) selected @endif>True</option>
                                <option value="0" @if (!$data['review']->getIsVisible()) selected @endif>False</option>
                            </select>
                            <input type="hidden" name="movie_id" value="{{ $data['review']->movie->getId() }}" /><br>
                            <input type="submit" style="text-align: center" value="Update Review" />
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
