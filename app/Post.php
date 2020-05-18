<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'caption',
        'profile_photo',
    ];
    public function likes()
    {
        return $this->belongsToMany(App\User::class, 'likes');
    }
    public function user()
    {
        return $this->belongsTo(App\User::class);
    }
    public function isLikedBy(?User $user)
    {
        
        return $user
               ? (bool)$this->likes->where('id' , $user->id)->count()
               : false;
    }
    public function getCountLikesAttribute()
    {
        return $this->likes->count();
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
