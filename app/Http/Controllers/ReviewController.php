<?php

namespace App\Http\Controllers;


use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create()
    {
        $data = [];
        $data["title"] = "Create review";

        dd($data);
    }

    public function show($id)
    {
        $data = [];
        $review = Review::findOrFail($id);

        $data["title"] = 'Review ' . $id;
        $data["review"] = $review;
        
        return view('review.show', ["data" => $data]);
    }

    public function save(Request $request)
    {
        Review::validate($request);
        $user = User::find(Auth::id());
        $review = new Review($request->only(["opinion","stars","is_visible","date","movie_id"]));
        $user->reviews()->save($review);
        return back()->with('success', 'Elemento Creado Satisfactoriamente');
    }

    public function list()
    {
        $data = Review::orderBy('id')->get();
        dd($data);
    }

    public function delete($id)
    {
        $review = Review::find($id);

        $review->delete();

        dd($review);
    }

    public function truncateReview(Request $request)
    {
        $review = Review::find($request->input("review_id"));

        $opinion = $review->getOpinion();
        
        $opinion = substr($opinion, 0, 50);
        
        dd($opinion);
    }
}
