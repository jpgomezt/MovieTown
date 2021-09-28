<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $recommended = MovieController::findRelated($request);
        $data["recommended_movies"] = $recommended;
        if (Auth::check()) {
            if (Auth::user()->getIsStaff()) {
                return redirect()->route('admin.home');
            }
        }
        return view('home.index', ['data' => $data]);
    }

    public function home()
    {
        if (Auth::check()) {
            if (Auth::user()->getIsStaff()) {
                return view('home.index');
            }
        }
        return redirect()->route('home.index');
    }
}
