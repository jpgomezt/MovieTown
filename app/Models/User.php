<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    // attributes id, name, email, password, address, username, is_staff, has_rented_movies,created_at, remember_token, updated_at
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'username',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'is_staff',
        'has_rented_movies',
    ];

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

    public function getUsername()
    {
        return $this->attributes['username'];
    }

    public function setUsername($username)
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
        return $this->attributes['is_staff'];
    }

    public function setIsStaff($is_staff)
    {
        $this->attributes['is_staff'] = $is_staff;
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
        return $this->attributes['has_rented_movies'];
    }

    public function setHasRentesMovies($has_rented_movies)
    {
        $this->attributes['has_rented_movies'] = $has_rented_movies;
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
