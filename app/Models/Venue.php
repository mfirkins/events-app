<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    public function events(){
        $this->hasMany(Event::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }
}
