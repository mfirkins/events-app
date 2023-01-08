<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content'
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
