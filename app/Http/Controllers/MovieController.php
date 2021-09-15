<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function create()
    {
        $data = []; //to be sent to the view
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
        $data = []; //to be sent to the view
        $movie = Movie::findOrFail($id);

        $data["title"] = $movie->getTitle();
        $data["plot"] = $movie->getPlot();
        $data["critics_score"] = $movie->getCriticsScore();
        $data["price"] = $movie->getPrice();
        $data["rent_quantity"] = $movie->getRentQuantity();
        $data["sell_quantity"] = $movie->getSellQuantity();
        $data["movie"] = $movie;

        dd($data);
        //return view('movie.show')->with("data", $data);
    }

    public function list()
    {
        $data = []; //to be sent to the view
        $data["page"] = "List of movies";
        $data["movies"] = Movie::all()->sortByDesc("id");

        dd($data);
        //return view('movie.list')->with("data", $data);
    }
}
