@extends('layouts.app')

@section('content')
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center" style="margin-top: -5%">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0">{{ __('home.heading_title') }}</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-tape"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">{{ __('home.heading_subtitle') }}
                <br> {{ __('home.curious') }}
                <br> {{ __('home.latitude') }}  {{ $data['iss_loc']['latitude'] }}
                <br> {{ __('home.longitude') }} {{ $data['iss_loc']['longitude'] }}
            </p>
        </div>
    </header>
    <!-- Recommended Movies Section-->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <!-- Recommended Movies Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">
                {{ __('home.recommended_title') }}</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-film"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Recommended Movies Grid Items-->
            @if ($data['recommended_movies'])
                <div class="row">
                    <!-- Recommended Movies as Items-->
                    @foreach ($data['recommended_movies'] as $movie)
                        <div class="col d-flex justify-content-center">
                            <div class="card text-center h-100" style="width: 18rem;">
                                <h5 class="card-header">{{ $movie->getTitle() }}</h5>
                                <img src="{{ URL::asset('storage/' . $movie->getId() . '.png') }}"
                                    class="card-img-top text-center img-thumbnail">
                                <a href="{{ route('movie.show', ['id' => $movie->getId()]) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col d-flex justify-content-center">
                    <h5>{{ __('home.recommended_error') }}</h5>
                </div>
                <div class="col d-flex justify-content-center">
                    <a class="badge" href="{{ route('movie.list') }}">
                        <h1>{{ __('home.recommended_movies_link') }} <i class="fas fa-ticket-alt"></i></h1>
                    </a>
                </div>
            @endif
        </div>
    </section>
    <!-- About Section-->
    <section class="page-section bg-primary text-white pb-0 mb-0" id="about">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">{{ __('home.about_title') }}</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- About Section Content-->
            <div class="row">
                <div class="col-lg-4 ml-auto">
                    <img src="{{ asset('/img/logos/movietown-transparent.png') }}" class="img-fluid rounded"
                        alt="Responsive image">
                </div>
                <div class="col-lg-4 mr-auto d-flex justify-content-center align-self-center">
                    <p class="lead">{{ __('home.about_content') }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
