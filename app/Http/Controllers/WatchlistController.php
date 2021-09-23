<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    public function show($id)
    {
        $data = [];

        $watchlist = Watchlist::findOrFail($id);

        $data["title"] = $watchlist->getName();
        $data["watchlist"] = $watchlist;
        //dd($data["watchlist"]);
        return view('watchlist.show', ['data'=> $data]);
    }

    public function create(Request $request)
    {
        $data = [];
        $data["title"] = "Create Watchlist";
        //dd($data["watchlists"]);
        return view('watchlist.create', ['data'=> $data]);
    }
    
    public function list()
    {
        $data = [];
        $data["title"] = "List Watchlists";
        $data["watchlists"] = Watchlist::orderBy('id', 'DESC')->get();

        $user = User::findOrFail(Auth::id());
        $data["watchlists"] = $user->watchlists;
        //dd($data["watchlists"]);
        return view('watchlist.list', ['data'=> $data]);
    }

    public function save(Request $request)
    {
        Watchlist::validate($request);
        $watchlist = new Watchlist($request->only(['name', 'description']));
        $user = User::find(Auth::id());
        $user->watchlists()->save($watchlist);
        //dd('Create watchlist successfully!!');
        return redirect()->route('watchlist.list');
    }

    public function delete($id)
    {
        $watchlist = Watchlist::find($id);
        $watchlist->delete();
        //dd("Watchlist ".$id.": Has been deleted");
        return back();
    }

    public function addMovie(Request $request, $id)
    {
        $user = User::find(Auth::id());
        $watchlist = $user->watchlists()
                          ->where('name', $request->input('name'))
                          ->first();
        $movie = Movie::findOrFail($id);
        $watchlist->movies()->attach($movie);
        dd("Movie added succesfully to watchlist (" . $watchlist['name'] . ") - Current movies in watchlist", $watchlist->movies);
    }

    public function removeMovie(Request $request, $id)
    {
        $user = User::find(Auth::id());
        $watchlist = $user->watchlists()
                          ->where('id', $request->input('watchlist_id'))
                          ->first();
        $movie = Movie::findOrFail($id);
        $watchlist->movies()->detach($movie);
        return back();
    }
}
