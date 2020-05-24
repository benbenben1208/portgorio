<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Post extends Model
{
    protected $fillable = [
        'caption',
        'profile_photo',
        'user_id',
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
    public function scopeWhereKeyword($query, $keyword = null)
    {
        if ($keyword) {
            $query->where('caption', 'LIKE', '%'. $keyword . '%');
        }
        return $query;
    }
    public function scopeWhereKeywordAdmin($query, $keyword = null)
    {
        
        if ($keyword) {
            $query->whereHas('user', function($query) use ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }) 
        ->orWhere('caption', 'LIKE', '%'. $keyword .'%');
           

        }
        return $query;
    }
    
    public function scopeWhereYears($query, $year = null)
    {
        if($year) {
            $query->whereYear('created_at' , $year);
        }
        return $query;
    }
    public function scopeWhereMonths($query, $month = null)
    {
        if($month) {
            $query->whereMonth('created_at', $month);
        }
        return $query;
    }
    public function scopeWhereDays($query, $day = null)
    {
        if($day) {
           $query->whereDay('created_at', $day);
        }
        return $query;
    }
}
