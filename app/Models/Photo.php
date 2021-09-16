<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'views',
        'path',
        'isPublic'
    ];


    //Relacion One to Many inverse   [*] --> 1
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //Relacion One to Many           [1] --> *
    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    //Relacion Many to Many
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')->withTimestamps();
    }

    public function getTagAttribute()
    {
        return $this->categories->pluck('tag');
    }

    //Rating sum
    public function getSumRating()
    {
        return $this->ratings()->get(['rating'])->sum('rating');
    }

    
}
