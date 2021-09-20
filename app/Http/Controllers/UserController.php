<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function show($id)
    {
        $data = []; //to be sent to the view

        $user = User::findOrFail($id);

        $data["title"] = $user->getName();
        $data["user"] = $user;
        dd($data["user"]->getUsername());
        //return view('user.show')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = "Create User";
        $data["users"] = User::all();
        dd($data["users"]);

        //return view('user.create')->with("data",$data);
    }
    
    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = "List Users";
        $data["users"] = User::orderBy('id', 'DESC')->get();
        dd($data["users"]);

        //return view('user.list')->with("data",$data);
    }

    public function save(Request $request)
    {
        User::validate($request);
        User::create($request->only(["name","username","email","password","address"]));

        //return back()->with('success','Elemento creado satisfactoriamente');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        dd("User ".$id.": Has been deleted");
        //return redirect()->route('user.list');
    }
}
