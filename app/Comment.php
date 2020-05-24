<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function scopeWhereKeyword($query, $keyword = null)
    {
        if($keyword) {
            $query->where('comment', 'LIKE', '%'. $keyword . '%');
        }
        return $query;
    }
    
   
    public function scopeWhereMonthly($query, $monthly = null)
    {
        if($monthly) {
            $query->whereMonth('created_at', $monthly);
        }
        return $query;
    }
}
