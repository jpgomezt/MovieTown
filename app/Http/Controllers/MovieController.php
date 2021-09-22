<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function create()
    {
        $data = [];
        $data["page"] = "Create Movie";

        dd($data);
        //return view('movie.create')->with("data", $data);
    }

    public function save(Request $request)
    {
        Movie::validate($request);
        Movie::create($request->only(["title", "plot", "critics_score", "price", "rent_quantity", "sell_quantity"]));

        dd($request);
        //return redirect()->route('home.index')->with('success', 'Movie created successfully!');
    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        dd($movie);
        return redirect()->route('movie.list')->with('success', 'Movie removed successfully!');
    }

    public function show($id)
    {
        $data = [];
        $movie = Movie::findOrFail($id);
        $data["movie"] = $movie;

        dd($data);
        //return view('movie.show')->with("data", $data);
    }

    public function list()
    {
        $data = [];
        $data["page"] = "List of movies";
        $data["movies"] = Movie::all();

        dd($data);
        //return view('movie.list')->with("data", $data);
    }

    public function filter(Request $request)
    {
        $rentQuantityOperator = '=';
        if ($request->input('isForRent') == 'true') {
            $rentQuantityOperator = '>';
        }
        $movies = Movie::where('title', 'like', '%' . $request->input('title') . '%')
                        ->where('critics_score', '>=', $request->input('score'))
                        ->where('price', '<=', $request->input('price'))
                        ->where('rent_quantity', $rentQuantityOperator, '0')
                        ->get();

        dd($movies);
    }
}
