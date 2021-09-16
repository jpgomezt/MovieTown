<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Review extends Model
{
    //attributes id, opinion, stars, date, isVisible, user_id, movie_id, created_at, updated_at
    protected $fillable = ['opinion','stars','date','isVisible','user_id','movie_id'];

    public static function validate(Request $request)
    {
        $request->validate([
            "opinion" => "required",
            "stars" => "required|numeric|gt:0",
            "isVisible" => "required|boolean",
            "date" => "required",
            "user" => "required",
            "movie" => "required"
        ]);
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

    public function setPrice($stars)
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

    public function getIsvisible()
    {
        return $this->attributes['isVisible'];
    }

    public function setIsvisible($visible)
    {
        $this->attributes['isVisible'] = $visible;
    }

    public function getUserId()
    {
        return strtoupper($this->attributes['user_id']);
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
