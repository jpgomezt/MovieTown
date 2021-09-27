<?php

namespace App\Util;

use App\Interfaces\ImageStorage;
use Illuminate\Support\Facades\Storage;

class ImageLocalStorage implements ImageStorage
{
    public function store($movie_id, $request)
    {
        if ($request->hasFile('movie_image')) {
            Storage::disk('public')->delete($movie_id . ".png");
            Storage::disk('public')->put($movie_id . ".png", file_get_contents($request->file('movie_image')->getRealPath()));
        }
    }
}
