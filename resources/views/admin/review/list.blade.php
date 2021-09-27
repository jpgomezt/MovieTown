@extends('layouts.app')

@section('title', $data['title'])

@section('content')
    <br>
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">List of reviews</h2>
    @if (count($data['list']) == 0)
        <br>
        <h4 class="page-section-body text-center">You don't have any reviews in the moment</h4>
        <br>
    @else
        @foreach ($data['list'] as $review)

            <div class="container" style="padding: 10px">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('admin.review.show', $review->getId()) }}">
                                    {{ $review->getId() }}
                                    || Movie: {{ $review->movie->getTitle() }} - By: {{ $review->user->getName() }}
                                </a>
                            </div>

                            <div class="card-body">
                                Stars: {{ $review->getStars() }}
                                <br>
                                Opinion: {{ $review->getOpinion() }}
                                <br>
                                Is visible: @if ($review->getIsVisible() == true) Yes :) @else No :( @endif
                                <br>
                                Date of publication: {{ $review->getDate() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
