<?php

/**
 * @author Juan Pablo Gómez
 */

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ImageStorage
{
    public function store($movie_id, Request $request);
}
