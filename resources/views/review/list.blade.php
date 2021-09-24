@extends('layouts.app')

@section('title', $data['title'])

@section('content')
<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">List of reviews</h2>
@foreach ( $data['list'] as $dt )
                        
<div class="container" style="padding: 10px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('review.show', $dt->getId()) }}"> 
                        {{ $dt->getId() }}
                    </a>
                    || Movie: {{ $dt->movie->getTitle() }} - By: {{ $dt->user->getName() }} 
                </div>

                <div class="card-body">
                    Stars: {{ $dt->getStars() }}
                    <br>
                    Opinion: {{ $dt->getOpinion() }}
                    <br>
                    Is visible: @if ( $dt->getIsVisible() == true ) Yes :) @else No :( @endif
                    <br>
                    Date of publication: {{ $dt->getDate() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
