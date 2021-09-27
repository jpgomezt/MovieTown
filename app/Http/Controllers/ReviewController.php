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
        }
        return redirect()->route('home.index');
    }

    public function show($id)
    {
        if (Auth::check()) {
            $data = [];
            $review = Review::with('movie')
                ->with('user')
                ->find($id);
            $data["title"] = 'Review ' . $id;
            $data["review"] = $review;
            if (Auth::user()->getIsStaff()) {
                return view('admin.review.show', ["data" => $data]);
            } else {
                return view('review.show', ["data" => $data]);
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
            if ($user->getIsStaff()) {
                return redirect()->route('admin.movie.show', ['id' => $request->input('movie_id')]);
            }
            return redirect()->route('movie.show', ['id' => $request->input('movie_id')]);
        }
        return redirect()->route('home.index');
    }

    public function list()
    {
        $data = [];
        $data['title'] = "List of Reviews";
        $user = Auth::user();
        if ($user->getIsStaff()) {
            $data['list'] = Review::with('movie')->with('user')->orderBy('id')->get();
            return view('admin.review.list', ["data" => $data]);
        } else {
            $data['list'] = Review::orderBy('id')
                ->with('movie')
                ->with('user')
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
            if (Auth::user()->getIsStaff()) {
                return redirect()->route('admin.movie.show', ['id' => $movie_id]);
            }
            return redirect()->route('movie.show', ['id' => $movie_id]);
        }
        return redirect()->route('home.index');
    }
    public function update($id)
    {
        if (Auth::check()) {
            $data = [];
            $user = Auth::user();
            $review = Review::with('movie')->find($id);
            if ($user->getIsStaff()) {
                $data = [];
                $data["title"] = 'Review ' . $id;
                $data["review"] = $review;
                return view('admin.review.update', ["data" => $data]);
            } else {
                $data["title"] = "Update review";
                $data['review'] = $review;
                return view('review.update', ["data" => $data]);
            }
            return redirect()->route('home.index');
        }
    }
    public function saveUpdate(Request $request, $id)
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
                $review->save();
                return redirect()->route('admin.movie.show', ['id' => $request->input('movie_id')]);
            }
            $review->save();
            return redirect()->route('movie.show', ['id' => $request->input('movie_id')]);
        }
        return redirect()->route('home.index');
    }
}
