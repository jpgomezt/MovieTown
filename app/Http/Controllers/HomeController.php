<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->getIsStaff()) {
                return redirect()->route('admin.home');
            }
        }
        return view('home.index');
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
