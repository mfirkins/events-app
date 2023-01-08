<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_name'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function venues(){
        return $this->hasMany(Venue::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }
}


