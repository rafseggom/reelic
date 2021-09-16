<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'photo_id',
        'user_id'
    ];


    //Relacion One to Many inverse   [*] --> 1
    public function photo()
    {
        return $this->belongsTo('App\Models\Photo');
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
