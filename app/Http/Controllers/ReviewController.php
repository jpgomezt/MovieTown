<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($id)
    {
        $data = [];
        $data["title"] = "Create review";
        $movie = Movie::find($id);
        $data['movie'] = $movie;
        return view('review.create', ["data" => $data]);
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
        $review = new Review($request->only(["opinion","stars", "movie_id"]));
        $review->setDate(date("Y/m/d"));
        $user->reviews()->save($review);
        return redirect()->route('movie.show', ['id' => $request->input('movie_id')]);
    }

    public function list()
    {
        $data = Review::orderBy('id')->get();
        dd($data);
    }

    public function delete($id)
    {
        $review = Review::findOrFail($id);
        $movie_id = $review->getMovieId();
        $review->delete();
        return redirect()->route('movie.show', ['id' => $movie_id]);
    }

    public function truncateReview(Request $request)
    {
        $review = Review::find($request->input("review_id"));

        $opinion = $review->getOpinion();
        
        $opinion = substr($opinion, 0, 50);
        
        dd($opinion);
    }
}
