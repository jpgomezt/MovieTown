<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $api_ext = Http::get('http://api.open-notify.org/iss-now.json');
        $data['iss_loc'] = $api_ext->json()['iss_position'];
        if (Auth::check()) {
            if (Auth::user()->getIsStaff()) {
                return redirect()->route('admin.home');
            }
        }
        $recommended = Movie::findRelated($request);
        $data["recommended_movies"] = $recommended;
        return view('home.index', ['data' => $data]);
    }

    public function home(Request $request)
    {
        $data = [];
        $api_ext = Http::get('http://api.open-notify.org/iss-now.json');
        $data['iss_loc'] = $api_ext->json()['iss_position'];
        if (Auth::check()) {
            if (Auth::user()->getIsStaff()) {
                $recommended = Movie::findRelated($request);
                $data["recommended_movies"] = $recommended;
                return view('home.index', ['data' => $data]);
            }
        }
        return redirect()->route('home.index');
    }
}
