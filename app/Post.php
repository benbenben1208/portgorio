<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Carbon\CarbonImmutable;
class Post extends Model
{
    protected $fillable = [
        'caption',
        'profile_photo',
        'user_id',
        'created_at',
    ];
    public function likes():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
    public function user():BelongsTo
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
    
    public function comments():HasMany
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
            $query->whereHas('user', function($query) use ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        })
           ->orWhereHas('comments', function($query) use ($keyword) {
            $query->where('comment', 'LIKE', '%' . $keyword . '%');
        })
        ->orWhere('caption', 'LIKE', '%'. $keyword .'%');
           

        }
        return $query;
    }

    public function scopeWherePostsInYear($query, $year = null)
    {
        if($year) {

          $dates = new CarbonImmutable();
          $start = $dates->setyear($year)->firstOfYear();
         
          $end = $start->endOfYear();
        
          $query->whereBetween('created_at', [$start, $end]);
          
        }
          return $query;
   
    }
    public function scopeWherePostsInMonth($query, $month, $year)
    {
        if($month) {
            $dates = new CarbonImmutable();
            $start = $dates->setMonth($month)->firstOfMonth();
            $end = $dates->setMonth($month)->endOfMonth();

            $query->whereBetween('created_at', [$start, $end]);
        }
        return $query;
    }
    public function scopeWherePostsInDay($query, $day)
    {
        if($day) {
            $dates = new CarbonImmutable();
            $start = $dates->setDay($day)->StartOfDay();
            $end = $dates->setDay($day)->endOfDay();

            $query->whereBetween('created_at', [$start, $end]);
        }
        return $query;
    }
}
