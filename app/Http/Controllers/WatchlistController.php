<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function create(Request $request)
    {
        $data = []; //to be sent to the view
        $data["title"] = "Create Watchlist";
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
        $watchlist = new Watchlist($request->only(['name', 'description']));
        $user = User::find(Auth::id());
        $user->watchlists()->save($watchlist);
        dd('Create watchlist successfully!!');

        //return back()->with('success','Elemento creado satisfactoriamente');
    }

    public function delete($id)
    {
        $watchlist = Watchlist::find($id);
        $watchlist->delete();
        dd("Watchlist ".$id.": Has been deleted");
        //return redirect()->route('watchlist.list');
    }

    public function addMovie(Request $request, $id)
    {
        // query and input methods are both valid
        //$watchlist = $user->watchlists()
        //                  ->where('name', 'rock watch')
        //                  ->first();
        $user = User::find(Auth::id());
        $watchlist = $user->watchlists()
                          ->where('name', $request->input('name'))
                          ->first();
        $movie = Movie::findOrFail($id);
        $watchlist->movies()->attach($movie);
        dd("Movie added succesfully to watchlist (".$watchlist['name'].") - Current movies in watchlist", $watchlist->movies);
    }

    public function removeMovie(Request $request, $id)
    {
        $user = User::find(Auth::id());
        $watchlist = $user->watchlists()
                          ->where('name', $request->input('name'))
                          ->first();
        $movie = Movie::findOrFail($id);
        $watchlist->movies()->detach($movie);
        dd('Movie removed succesfully from watchlist ('.$watchlist['name'].") - Current movies in watchlist", $watchlist->movies);
    }
}
