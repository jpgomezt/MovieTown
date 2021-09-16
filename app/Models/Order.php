<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Order extends Model
{

    //attributes id, address, date, paymentType, shippingDate, shippingCost, total, is_Shipped, user_id, created_at, updated_at
    protected $fillable = ['address','date','paymentType','shippingDate','shippingCost','total', 'is_Shipped', 'user_id' ];

    public static function validate(Request $request)
    {
        $request->validate([
            "adress" => "required",
            "date" => "required",
            "paymetType" => "required|numeric",
            "shippingDate" => "required",
            "shippingCost" => "required",
            "total" => "required|numeric|gt:0",
            "is_Shipped" => "required|boolean", "user_id"
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

    public function getAdress()
    {
        return $this->attributes['adress'];
    }

    public function setAdress($adress)
    {
        $this->attributes['adress'] = $adress;
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
        return $this->attributes['paymentType'];
    }

    public function setPaymentType($paymentType)
    {
        $this->attributes['paymentType'] = $paymentType;
    }

    public function getShippingDate()
    {
        return $this->attributes['shippingDate'];
    }

    public function setShippingDate($shippingDate)
    {
        $this->attributes['shippingDate'] = $shippingDate;
    }

    public function getShippingCost()
    {
        return $this->attributes['shippingCost'];
    }

    public function setShippingCost($shippingCost)
    {
        $this->attributes['shippingCost'] = $shippingCost;
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
        return $this->attributes['isShipped'];
    }

    public function setIsShipped($isShipped)
    {
        $this->attributes['isShipped'] = $isShipped;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUserId($user_id)
    {
        $this->attributes['user_id'] = $user_id;
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
