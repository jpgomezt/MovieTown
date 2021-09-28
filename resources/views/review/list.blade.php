@extends('layouts.app')

@section('title', __('review.list_of_reviews'))

@section('content')
    <br>
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{ __('review.list_of_reviews') }}</h2>
    @if (count($data['list']) == 0)
        <br>
        <h4 class="page-section-body text-center">{{ __('review.you_dont_have_any') }}</h4>
        <br>
    @else
        @foreach ($data['list'] as $review)

            <div class="container" style="padding: 10px">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('review.show', $review->getId()) }}">
                                    {{ __('review.movie') }}: {{ $review->movie->getTitle() }} -
                                    {{ __('review.by') }}:
                                    {{ $review->user->getName() }}
                                </a>
                            </div>

                            <div class="card-body">
                                {{ __('review.stars') }}: {{ $review->getStars() }}
                                <br>
                                {{ __('review.opinion') }}: {{ $review->getOpinion() }}
                                <br>
                                {{ __('review.is_visible') }}: @if ($review->getIsVisible() == true) Yes  @else No  @endif
                                <br>
                                {{ __('review.publish_date') }}: {{ $review->getDate() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
