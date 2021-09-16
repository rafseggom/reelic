<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'tag'

    ];

    //Relacion Many to Many
    public function photos()
    {
        return $this->belongsToMany('App\Models\Photo')->withTimestamps();
    }
}
