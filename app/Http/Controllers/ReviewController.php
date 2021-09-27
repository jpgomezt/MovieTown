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
                $review = Review::find($id);
                $data = [];
                $data["title"] = 'Review ' . $id;
                $data["review"] = $review;
                return view('admin.review.show', ["data" => $data]);
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
            return view('admin.review.list', ["data" => $data]);
        } else {
            $data['list'] = Review::orderBy('id')
                ->where('user_id', $user->getId())
                ->get();
            return view('review.list', ["data" => $data]);
        }
        return redirect()->route('home.index');
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
    public function update($id)
    {
        if (Auth::check()) {
            $data = [];
            $user = Auth::user();
            if ($user->getIsStaff()) {
                $review = Review::find($id);
                $data = [];
                $data["title"] = 'Review ' . $id;
                $data["review"] = $review;
                return view('admin.review.update', ["data" => $data]);
            } else {
                $review = $user->reviews
                    ->where('id', $id)
                    ->first();
                if ($review !== null) {
                    $data["title"] = "Update review";
                    $data['review'] = Review::findOrFail($id);
                    return view('review.update', ["data" => $data]);
                }
                return back();
            }
        } else {
            return redirect()->route('home.index');
        }
    }
    public function updateProcess(Request $request, $id)
    {
        if (Auth::check()) {
            Review::validate($request);
            $user = Auth::user();
            $review = Review::findOrFail($id);
            $review->setOpinion($request->input('opinion'));
            $review->setStars($request->input('stars'));
            $review->setMovieId($request->input('movie_id'));
            $review->setDate(date("Y/m/d"));
            if ($user->getIsStaff()) {
                $review->setIsVisible($request->input('is_visible'));
            }
            $review->save();
            return redirect()->route('movie.show', ['id' => $request->input('movie_id')]);
        } else {
            return redirect()->route('home.index');
        }
    }
}
