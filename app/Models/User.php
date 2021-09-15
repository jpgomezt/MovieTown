<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // atributes id, name, email, password, address, username, created_at, remember_token, updated_at
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function validate(Request $request)
    {
        $request->validate([
            "name" => "required",
            "username" => "required",
            "email" => "required",
            "password" => "required",
            "address" => "required",
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

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getUserName()
    {
        return $this->attributes['username'];
    }

    public function setUserName($username)
    {
        $this->attributes['username'] = $username;
    }

    public function getEmail()
    {
        return $this->attributes['email'];
    }

    public function setEmail($email)
    {
        $this->attributes['email'] = $email;
    }

    public function getAddress()
    {
        return $this->attributes['address'];
    }

    public function setAddress($address)
    {
        $this->attributes['address'] = $address;
    }

    public function getIsStaff()
    {
        return $this->attributes['isStaff'];
    }

    public function setIsStaff($isStaff)
    {
        $this->attributes['isStaff'] = $isStaff;
    }

    public function getPassword()
    {
        return $this->attributes['password'];
    }

    public function setPassword($password)
    {
        $this->attributes['password'] = $password;
    }

    public function getHasRentedMovies()
    {
        return $this->attributes['hasRentedMovies'];
    }

    public function setHasRentesMovies($hasRentedMovies)
    {
        $this->attributes['hasRentedMovies'] = $hasRentedMovies;
    }

    public function viewed()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function watchlists()
    {
        return $this->belongsToMany(Watchlist::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function reviews()
    {
        return $this->belongsToMany(Review::class);
    }
}
