<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Item extends Model
{

    //attributes id, is_rented, return_date, quantity, subtotal, movie_id, order_id, created_at, updated_at
    protected $fillable = ['is_rented', 'return_date', 'quantity', 'subtotal', 'movie_id', 'order_id'];

    public static function validate(Request $request)
    {
        $request->validate([
            "is_rented" => "required|boolean",
            "return_date" => "required|date",
            "quantity" => "required|numeric|gt:0",
            "subtotal" => "required|integer|gt:0", 'movie_id', 'order_id'
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

    public function getIsRented()
    {
        return $this->attributes['is_rented'];
    }

    public function setIsRented($is_rented)
    {
        $this->attributes['is_rented'] = $is_rented;
    }

    public function getReturnDate()
    {
        return $this->attributes['return_date'];
    }

    public function setReturnDate($return_date)
    {
        $this->attributes['return_date'] = $return_date;
    }

    public function getQuantity()
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity($quantity)
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function getSubtotal()
    {
        return $this->attributes['subtotal'];
    }

    public function setSubtotal($subtotal)
    {
        $this->attributes['subtotal'] = $subtotal;
    }

    public function getMovieId()
    {
        return $this->attributes['movie_id'];
    }

    public function setMovieId($movie_id)
    {
        $this->attributes['movie_id'] = $movie_id;
    }

    public function getOrderId()
    {
        return $this->attributes['order_id'];
    }

    public function setOrderId($order_id)
    {
        $this->attributes['order_id'] = $order_id;
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
