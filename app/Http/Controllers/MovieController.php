<?php

namespace App\Http\Controllers;

use App\Interfaces\ImageStorage;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{

    public function create()
    {
        $data = [];
        $data["title"] = "Create Movie";

        return view('movie.create', ['data' => $data]);
    }

    public function save(Request $request)
    {
        #VALIDATE IMAGE
        Movie::validate($request);
        $movie = Movie::create($request->only(["title", "plot", "critics_score", "price", "rent_quantity", "sell_quantity"]));
        $storeInterface = app(ImageStorage::class);
        $storeInterface->store($movie->getId(), $request);


        return redirect()->route('movie.show', ['id' => $movie->getId()]);
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
        $data["movie"] = Movie::with('reviews.user')->find($id);

        if (Auth::check()) {
            $data["watchlists"] = Auth::user()->watchlists;
        }

        return view('movie.show', ['data' => $data]);
    }

    public function list()
    {
        $data = [];
        $data["title"] = "List of movies";
        $data["movies"] = Movie::all();

        return view('movie.list', ['data' => $data]);
    }

    public function filter(Request $request)
    {
        if (is_null($request->input('title'))) {
            $title = "";
        } else {
            $title = $request->input('title');
        }

        if (is_null($request->input('price'))) {
            $price = PHP_INT_MAX;
        } else {
            $price = $request->input('price');
        }

        $data = [];
        $data["title"] = "Filtered Movies";
        $rentQuantityOperator = '>=';
        if ($request->input('rent') == 'on') {
            $rentQuantityOperator = '>';
        }
        $data["movies"] = Movie::where('title', 'like', '%' . $title . '%')
            ->where('critics_score', '>=', $request->input('score'))
            ->where('price', '<=', $price)
            ->where('rent_quantity', $rentQuantityOperator, '0')
            ->get();

        return view('movie.list', ['data' => $data]);
    }
}
