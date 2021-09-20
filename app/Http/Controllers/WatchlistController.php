<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use App\Models\Movie;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    public function show($id)
    {
        $data = []; //to be sent to the view

        $watchlist = Watchlist::findOrFail($id);

        $data["title"] = $watchlist->getName();
        $data["watchlist"] = $watchlist;
        //dd($data["watchlist"]->getDescription());
        dd($data["watchlist"]->movies);
        //return view('watchlist.show')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = "Create Watchlist";
        $data["watchlists"] = Watchlist::all();
        dd($data["watchlists"]);

        //return view('watchlist.create')->with("data",$data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = "List Watchlists";
        $data["watchlists"] = Watchlist::orderBy('id', 'DESC')->get();
        dd($data["watchlists"]);

        //return view('watchlist.list')->with("data",$data);
    }

    public function save(Request $request)
    {
        Watchlist::validate($request);
        Watchlist::create($request->only(["name","description"]));

        //return back()->with('success','Elemento creado satisfactoriamente');
    }

    public function delete($id)
    {
        $watchlist = Watchlist::find($id);
        $watchlist->delete();
        dd("Watchlist ".$id.": Has been deleted");
        //return redirect()->route('watchlist.list');
    }

    public function addMovie()
    {
        $movie = Movie::findOrFail(1);
        $watchlist = Watchlist::find(1);
        $watchlist->movies()->attach($movie);
        dd('Movie added succesfully to watchlist', $movie, $watchlist, $watchlist->movies);
    }

    public function removeMovie()
    {
        $movie = Movie::findOrFail(1);
        $watchlist = Watchlist::find(1);
        $watchlist->movies()->detach($movie);
        dd('Movie removed succesfully from watchlist', $movie, $watchlist);
    }
}
