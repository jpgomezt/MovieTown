<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThisController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->getIsStaff()) {
                return redirect()->route('admin.home');
            }
        }
        $data = [];
        $recommended = Movie::findRelated($request);
        $data["recommended_movies"] = $recommended;
        return view('home.index', ['data' => $data]);
    }

    public function apiNoKey(Request $request)
    {
        $client = new Client();
        //$url = "https://api.github.com/users/kingsconsult/repos";
        $url = "http://techsavies.tk/public/api/products";

        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody());

        $data['api'] = $responseBody->data;
        #return dd($responseBody->data);
        #return $responseBody;
        return view('api.apiNoKey', ['data' => $data]);
        //return view('projects.apiwithoutkey', compact('responseBody'));
        //return view('api.apiNoKey', ['data' => $data]);
    }
}
