@extends('layouts.app')

@section('title', $data['review']->movie->getTitle())

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card ">
            <div class="card-header text-center" style="font-size: 35px;">{{ __("review.movie") }}: {{ $data['review']->movie->getTitle() }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <b>{{ __("review.written_by") }}: </b><br>
                        <span style="font-size: 25px">{{ $data['review']->user->getName() }}</span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <b>{{ __("review.written_in") }}:</b> {{ $data['review']->getDate() }}<br>
                        <b>{{ __("review.opinion") }}:</b> {{ $data['review']->getOpinion() }}<br>
                        <b style="text-align: center">{{ __("review.stars") }}: </b> {{ $data['review']->getStars() }}<br>
                        @for ($i = 0; $i < round($data['review']->getStars()); $i++)
                            <i class="fas fa-star" style="color: yellow"></i>
                        @endfor
                        <br><br>
                        <div class="row">
                            <div class="col-sm-2">
                                <form method="POST"
                                    action="{{ route('admin.review.delete', ['id' => $data['review']->getId()]) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="{{ __("review.delete") }}">
                                </form>
                            </div>
                            <div class="col-sm-2">
                                <form method="GET"
                                    action="{{ route('admin.review.update', ['id' => $data['review']->getId()]) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-info" value="{{ __("review.update") }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
