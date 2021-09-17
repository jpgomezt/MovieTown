<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Review extends Model
{
    //attributes id, opinion, stars, date, is_visible, user_id, movie_id, created_at, updated_at
    protected $fillable = ['opinion','stars','date','is_visible','user_id','movie_id'];

    public static function validate(Request $request)
    {
        $request->validate([
            "opinion" => "required",
            "stars" => "required|numeric|gt:0",
            "is_visible" => "required|boolean",
            "date" => "required|date",]);
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getOpinion()
    {
        return $this->attributes['opinion'];
    }

    public function setOpinion($opinion)
    {
        $this->attributes['opinion'] = $opinion;
    }

    public function getStars()
    {
        return $this->attributes['stars'];
    }

    public function setStars($stars)
    {
        $this->attributes['stars'] = $stars;
    }

    public function getDate()
    {
        return $this->attributes['date'];
    }

    public function setDate($date)
    {
        $this->attributes['date'] = $date;
    }

    public function getIsVisible()
    {
        return $this->attributes['is_visible'];
    }

    public function setIsVisible($is_visible)
    {
        $this->attributes['is_visible'] = $is_visible;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUserId($user_id)
    {
        $this->attributes['user_id'] = $user_id;
    }

    public function getMovieId()
    {
        return $this->attributes['movie_id'];
    }

    public function setMovieId($movie_id)
    {
        $this->attributes['movie_id'] = $movie_id;
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
