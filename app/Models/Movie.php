<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Movie extends Model
{

    //attributes id, title, plot, critics_score, price, rent_quantity, sell_quantity, created_at, updated_at
    protected $fillable = ['title', 'plot', 'critics_score', 'price', 'rent_quantity', 'sell_quantity'];

    public static function validate(Request $request)
    {
        $request->validate([
            "title" => "required",
            "plot" => "required",
            // In order to use regex with '|' character, you need to specify rules in an array
            "critics_score" => [
                'required',
                'numeric',
                'gte:0',
                'lte:5',
                'regex:/^[0-4]+\.+[0-9]|[0-5]$/',
            ],
            "price" => "required|numeric|gt:0",
            "rent_quantity" => "required|numeric|gte:0",
            "sell_quantity" => "required|numeric|gte:0",
            "movie_image" => "image",
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

    public function getTitle()
    {
        return $this->attributes['title'];
    }

    public function setTitle($title)
    {
        $this->attributes['title'] = $title;
    }

    public function getPlot()
    {
        return $this->attributes['plot'];
    }

    public function setPlot($plot)
    {
        $this->attributes['plot'] = $plot;
    }

    public function getCriticsScore()
    {
        return $this->attributes['critics_score'];
    }

    public function setCriticsScore($critics_score)
    {
        $this->attributes['critics_score'] = $critics_score;
    }

    public function getPrice()
    {
        return $this->attributes['price'];
    }

    public function setPrice($price)
    {
        $this->attributes['price'] = $price;
    }

    public function getRentQuantity()
    {
        return $this->attributes['rent_quantity'];
    }

    public function setRentQuantity($rent_quantity)
    {
        $this->attributes['rent_quantity'] = $rent_quantity;
    }

    public function getSellQuantity()
    {
        return $this->attributes['sell_quantity'];
    }

    public function setSellQuantity($sell_quantity)
    {
        $this->attributes['sell_quantity'] = $sell_quantity;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function watchlists()
    {
        return $this->belongsToMany(Watchlist::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
