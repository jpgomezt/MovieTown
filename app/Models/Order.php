<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Order extends Model
{
    /*
        attributes id, address, date, payment_type, shipping_date,
        shipping_cost, total, is_shipped, user_id, created_at, updated_at
    */
    protected $fillable = ['address','date','payment_type','shipping_date',
    'shipping_cost','total', 'is_shipped', 'user_id' ];

    public static function validate(Request $request)
    {
        $request->validate([
            "address" => "required",
            "date" => "required|date",
            "payment_type" => "required",
            "shipping_date" => "required",
            "shipping_cost" => "required",
            "total" => "required|numeric|min:0|not_in:0",
            "is_shipped" => "required|boolean",]);
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getAddress()
    {
        return $this->attributes['address'];
    }

    public function setAddress($address)
    {
        $this->attributes['address'] = $address;
    }

    public function getDate()
    {
        return $this->attributes['date'];
    }

    public function setDate($date)
    {
        $this->attributes['date'] = $date;
    }

    public function getPaymentType()
    {
        return $this->attributes['payment_type'];
    }

    public function setPaymentType($payment_type)
    {
        $this->attributes['payment_type'] = $payment_type;
    }

    public function getShippingDate()
    {
        return $this->attributes['shipping_date'];
    }

    public function setShippingDate($shipping_date)
    {
        $this->attributes['shipping_date'] = $shipping_date;
    }

    public function getShippingCost()
    {
        return $this->attributes['shipping_cost'];
    }

    public function setShippingCost($shipping_cost)
    {
        $this->attributes['shipping_cost'] = $shipping_cost;
    }

    public function getTotal()
    {
        return $this->attributes['total'];
    }

    public function setTotal($total)
    {
        $this->attributes['total'] = $total;
    }

    public function getIsShipped()
    {
        return $this->attributes['is_shipped'];
    }

    public function setIsShipped($is_shipped)
    {
        $this->attributes['is_shipped'] = $is_shipped;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUserId($user_id)
    {
        $this->attributes['user_id'] = $user_id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
