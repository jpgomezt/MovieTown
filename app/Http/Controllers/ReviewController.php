<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /*
        $id -> Movie ID
    */
    public function create($id)
    {
        if (Auth::check()) {
            $data = [];
            $data["title"] = "Create review";
            $movie = Movie::find($id);
            $data['movie'] = $movie;
            return view('review.create', ["data" => $data]);
        } else {
            return redirect()->route('home.index');
        }
    }

    public function show($id)
    {
        if (Auth::check()) {
            $data = [];
            $user = Auth::user();
            $review = $user->reviews()
                ->where('id', $id)
                ->first();
            if ($review !== null) {
                $review = Review::findOrFail($id);
                $data["title"] = 'Review ' . $id;
                $data["review"] = $review;

                return view('review.show', ["data" => $data]);
            } elseif ($user->getIsStaff()) {
                dd('Es admin! Todo lo puede ver!');
            }
        }
        return redirect()->route('home.index');
    }

    public function save(Request $request)
    {
        if (Auth::check()) {
            Review::validate($request);
            $user = User::find(Auth::id());
            $review = new Review($request->only(["opinion", "stars", "movie_id"]));
            $review->setDate(date("Y/m/d"));
            $user->reviews()->save($review);
            return redirect()->route('movie.show', ['id' => $request->input('movie_id')]);
        } else {
            return redirect()->route('home.index');
        }
    }

    public function list()
    {
        $data = [];
        $data['title'] = "List of Reviews";
        $user = Auth::user();
        if ($user->getIsStaff()) {
            $data['list'] = Review::orderBy('id')->get();
            dd('Es admin! Todo lo puede ver!');
        } else {
            $data['list'] = Review::orderBy('id')->where('user_id', $user->getId())->get();
        }
        return view('review.list', ["data" => $data]);
    }

    public function delete($id)
    {
        if (Auth::check()) {
            $review = Review::findOrFail($id);
            $movie_id = $review->getMovieId();
            $review->delete();
            return redirect()->route('movie.show', ['id' => $movie_id]);
        } else {
            return redirect()->route('home.index');
        }
    }

    /*
        $id -> Review ID
    */
    public function update($id)
    {
        if (Auth::check()) {
            $data = [];
            $user = Auth::user();
            $review = $user->reviews()
                ->where('id', $id)
                ->first();
            if ($review !== null) {
                $data["title"] = "Update review";
                $data['review'] = Review::findOrFail($id);

                return view('review.update', ["data" => $data]);
            } elseif ($user->getIsStaff()) {
                dd('Es admin! Todo lo puede ver!');
            }
        } else {
            return redirect()->route('home.index');
        }
    }

    /*
        $request -> Request of the form
        $id -> Review ID
    */
    public function updateProcess(Request $request, $id)
    {
        if (Auth::check()) {
            Review::validate($request);
            $user = User::find(Auth::id());
            $review = Review::findOrFail($id);
            $review->setOpinion($request->input('opinion'));
            $review->setStars($request->input('stars'));
            $review->setMovieId($request->input('movie_id'));
            $review->setDate(date("Y/m/d"));
            $user->reviews()->save($review);
            return redirect()->route('movie.show', ['id' => $request->input('movie_id')]);
        } else {
            return redirect()->route('home.index');
        }
    }

    public function truncateReview(Request $request)
    {

        $review = Review::find($request->input("review_id"));

        $opinion = $review->getOpinion();

        $opinion = substr($opinion, 0, 50);

        dd($opinion);
    }
}
