@extends('layouts.app')

@section('content')
<!-- About Section-->
<section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container">
        <!-- About Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-white">Movie: {{ $data['review']->movie->getTitle() }}</h2>
        <h4 class="page-section-heading text-center text-white">Written at: {{ $data['review']->getDate() }}</h4>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            @for ($i = 0; $i < $data['review']->getStars(); $i++)
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            @endfor
            <div class="divider-custom-line"></div>
        </div>
        <!-- About Section Content-->
        <div class="row">
            <div class="col-lg-4 ml-auto"><p class="lead">Written by: <br> {{ $data['review']->user->getName() }}</p></div>
            <div class="col-lg-4 mr-auto"><p class="lead">{{ $data['review']->getOpinion() }}</p></div>
        </div>
        <!-- About Section Button-->
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-outline-light" href="https://startbootstrap.com/themes/freelancer/">
                <i class="far fa-trash-alt mr-2"></i>
                Delete
            </a>
            &nbsp;
            <a class="btn btn-xl btn-outline-light" href="https://startbootstrap.com/themes/freelancer/">
                <i class="far fa-paper-plane mr-2"></i>
                Request to be visible
            </a>
        </div>
    </div>
</section>
<!-- Contact Section-->

@endsection
