@extends('layouts.app')


@section('content')

 @foreach ($data['api']  as $response) 
 <div> {{ $response->title }}</div> </ b>
 @endforeach

@endsection
