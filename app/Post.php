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
        return $this->belongsToMany('App\User', 'likes');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
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
}
