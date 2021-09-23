@extends('layouts.app')

@section('title')
{{ $data["title"] }}
@endsection

@section('content')
<h1>{{ $data["title"] }}</h1>
<form action="{{ route('watchlist.save') }}" method="post">
    @csrf
    <div class="form-group">
      <label for="watchlist-name">Name</label>
      <input type="text" class="form-control" id="watchlist-name" aria-describedby="emailHelp" name="name">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="text" class="form-control" id="description" name="description">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>

@endsection
