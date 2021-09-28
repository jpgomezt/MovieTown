@extends('layouts.app')

@section('title', __('review.review') . $data['review']->getId())

@section('content')
    <div class="container" style="padding: 15px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header" style="text-align: center; font-size: 25px">{{ __('review.review') }}
                        {{ $data['review']->getId() }}:
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
                            action="{{ route('admin.review.saveUpdate', ['id' => $data['review']->getId()]) }}">
                            @csrf
                            <style>
                                input {
                                    margin: 5px;
                                    text-align: left;
                                    width: 100%;
                                }

                            </style>

                            <input type="text" placeholder="{{ __('review.comment_about_movie') }}" name="opinion"
                                style="height: 60px; width: 100%;" value="{{ $data['review']->getOpinion() }}" /><br>
                            <input type="number" step="0.1" placeholder="{{ __('review.number_of_stars') }}" name="stars"
                                min="1" max="5" value="{{ $data['review']->getStars() }}" /><br>
                            <label for="is_visible">{{ __('review.make_comment_visible') }}:</label>
                            <select name="is_visible" id=="is_visible">
                                <option value="1" @if ($data['review']->getIsVisible()) selected @endif>{{ __('review.yes') }}</option>
                                <option value="0" @if (!$data['review']->getIsVisible()) selected @endif>{{ __('review.no') }}</option>
                            </select>
                            <input type="hidden" name="movie_id" value="{{ $data['review']->movie->getId() }}" /><br>
                            <input type="submit" style="text-align: center" value="{{ __('review.update_review') }}" />
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
