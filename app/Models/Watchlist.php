<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Watchlist extends Model
{

    //attributes id, name, description, user_id, created_at, updated_at
    protected $fillable = ['name', 'description', 'user_id'];

    public static function validate(Request $request)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
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

    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUserId($user_id)
    {
        return $this->attributes['user_id'];
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
