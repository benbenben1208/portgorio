<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function followers()
    {
        return $this->belongsToMany('App\User', 'follows' , 'followee_id', 'follower_id')->withTimestamps();
    }
    public function followees()
    {
        return $this->belongsToMany(User::class , 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }
    public function isFollowedBy(?User $user)
    {
        return $user 
               ? (bool) $this->followers->where('id' , $user->id)->count()
               : false;
    }
    public function getCountFollowersAttribute()
    {
        return $this->followers->count();
    }
    public function getCountFolloweesAttribute()
    {
        return $this->followees->count();
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
}
