<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Models\Movie;

class MovieApi extends Controller
{
    public function index()
    {
        return MovieResource::collection(Movie::all());
    }

    public function show($id)
    {
        return new MovieResource(Movie::findOrFail($id));
    }
}
