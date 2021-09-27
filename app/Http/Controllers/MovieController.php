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
        if (Auth::check()) {
            if (Auth::user()->getIsStaff()) {
                $data = [];
                $data["title"] = "Create Movie";
                return view('admin.movie.create', ['data' => $data]);
            }
        }
        return back();
    }

    public function save(Request $request)
    {
        #VALIDATE IMAGE
        Movie::validate($request);
        $movie = Movie::create($request->only(["title", "plot", "critics_score", "price", "rent_quantity", "sell_quantity"]));
        $storeInterface = app(ImageStorage::class);
        $storeInterface->store($movie->getId(), $request);
        return redirect()->route('admin.movie.show', ['id' => $movie->getId()]);
    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        //dd($movie);
        //return redirect()->route('movie.list')->with('success', 'Movie removed successfully!');
        return back();
    }

    public function show($id)
    {
        $data = [];
        $data["movie"] = Movie::with('reviews.user')->find($id);

        if (Auth::check()) {
            $user = Auth::user();
            $data["watchlists"] = $user->watchlists;
            if ($user->getIsStaff()){
               return  view('admin.movie.show', ['data' => $data]);
            }
            $data["watchlists"] = Auth::user()->watchlists;
        }

        return view('movie.show', ['data' => $data]);
    }

    public function update($id)
    {
        if (Auth::check()) {
            if (Auth::user()->getIsStaff()) {
                $movie = Movie::find($id);
                $data = [];
                $data["title"] = "Update Movie";
                $data["movie"] = $movie;

                return view('admin.movie.update', ['data' => $data]);
            }
        }
        return back();
    }

    public function saveUpdate(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->getIsStaff()) {
                $movie = Movie::find($request->input('movie_id'));

                $movie->setTitle($request->input('title'));
                $movie->setPlot($request->input('plot'));
                $movie->setPrice($request->input('price'));
                $movie->setCriticsScore($request->input('critics_score'));
                $movie->setRentQuantity($request->input('rent_quantity'));
                $movie->setSellQuantity($request->input('sell_quantity'));
                $storeInterface = app(ImageStorage::class);
                $storeInterface->store($movie->getId(), $request);
                $movie->save();

                $data = [];
                $data["title"] =  "hola";
                $data['movie'] = $movie;
                $data["watchlists"] = Auth::user()->watchlists;

                return redirect()->route('admin.movie.show', ['id' => $movie->getId()]);
            }
        }
        return redirect()->route('movie.show');
    }

    public function list()
    {
        $data = [];
        $data["title"] = "List of movies";
        $data["movies"] = Movie::all();
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->getIsStaff()) {
                return view('admin.movie.list', ['data' => $data]);
            }
        }
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

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->getIsStaff()) {
                return view('admin.movie.list', ['data' => $data]);
            }
        }

        return view('movie.list', ['data' => $data]);
    }
}
