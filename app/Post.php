<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Post extends Model
{
    protected $fillable = [
        'caption',
        'profile_photo',
    ];
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
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
        return $this->hasMany(Comment::class);
    }
    public function tags():BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
