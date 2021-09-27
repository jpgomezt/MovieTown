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
        if (Auth::check()) {
            $user = Auth::user();
            $data = [];
            if ($user->getIsStaff()) {
                $watchlist = Watchlist::with('movies')
                    ->find($id);
                $data["title"] = $watchlist->getName();
                $data["watchlist"] = $watchlist;
                return view('admin.watchlist.show', ['data' => $data]);
            } else {
                $watchlist = Watchlist::with('movies')
                    ->where('user_id', Auth::id())
                    ->find($id);
                if ($watchlist !== null) {
                    $data["title"] = $watchlist->getName();
                    $data["watchlist"] = $watchlist;
                    return view('watchlist.show', ['data' => $data]);
                }
            }
        }
        return redirect()->route('home.index');
    }

    public function create(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $data = [];
            $data["title"] = "Create Watchlist";
            if ($user->getIsStaff()) {
                $data["users"] = User::where('is_staff', 0)->get();
                return view('admin.watchlist.create', ['data' => $data]);
            } else {
                return view('watchlist.create', ['data' => $data]);
            }
        }
        return redirect()->route('home.index');
    }

    public function list()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $data = [];
            $data["title"] = "List Watchlists";
            if ($user->getIsStaff()) {
                $users = User::with('watchlists')->where('is_staff', 0)->get();
                $data["users"] = $users;
                return view('admin.watchlist.list', ['data' => $data]);
            } else {
                $data["watchlists"] = $user->watchlists;
                return view('watchlist.list', ['data' => $data]);
            }
        }
        return redirect()->route('home.index');
    }

    public function save(Request $request)
    {
        if (Auth::check()) {
            Watchlist::validate($request);
            $watchlist = new Watchlist($request->only(['name', 'description']));
            $user = Auth::user();
            if ($user->getIsStaff()) {
                $watchlist_user = User::find($request->input('user_id'));
                $watchlist_user->watchlists()->save($watchlist);
                return redirect()->route('admin.watchlist.list');
            } else {
                $user->watchlists()->save($watchlist);
                return redirect()->route('watchlist.list');
            }
        }
        return back();
    }

    public function delete($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->getIsStaff() === 1) {
                Watchlist::find($id)->delete();
            } else {
                $watchlist = $user->watchlists->find($id);
                if ($watchlist !== null) {
                    $watchlist->delete();
                }
            }
        }
        return back();
    }

    public function addMovie(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->getIsStaff()) {
                //dd('Eres admin');
                $watchlist = Watchlist::findOrFail($request->input('watchlist_id'));
                $movie = Movie::findOrFail($request->input('movie_id'));
                $watchlist->movies()->attach($movie);
                return redirect()->route('watchlist.show', ["id" => $request->input('watchlist_id')]);
            } else {
                $watchlist = $user->watchlists
                    ->find($request->input('watchlist_id'));

                if ($watchlist !== null) {
                    $movie = Movie::findOrFail($request->input('movie_id'));
                    $watchlist->movies()->attach($movie);
                    return redirect()->route('watchlist.show', ["id" => $request->input('watchlist_id')]);
                }
            }
        }
        return back();
    }

    public function removeMovie(Request $request, $id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->getIsStaff() === 1) {
                //dd('Eres admin');
                $watchlist = Watchlist::findOrFail($request->input('watchlist_id'));
                $movie = Movie::findOrFail($id);
                $watchlist->movies()->detach($movie);
            } else {
                $watchlist = $user->watchlists
                    ->where('id', $request->input('watchlist_id'))
                    ->first();
                $movie = Movie::findOrFail($id);
                $watchlist->movies()->detach($movie);
            }
        }
        return back();
    }
}
