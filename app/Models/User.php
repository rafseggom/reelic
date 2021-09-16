<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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



    //Relacion One to Many  [1] --> *
    public function photos()
    {
        return $this->hasMany('App\Models\Photo');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    //Followers
        public function followers()
        {
            return $this->belongsTo('App\Models\User', 'follows', 'user_id', 'follow_id');
        }

    public function follows()
    {
        return $this->belongsToMany('App\Models\User', 'follows', 'user_id', 'follow_id');
    }

    public function getTotalPhotos()
    {
        return $this->photos()->count('rating');
    }

}

