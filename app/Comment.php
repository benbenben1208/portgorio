<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonImmutable;
use App\User;

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
           $query->whereHas('user', function($query) use ($keyword) {
               $query->where('comments', 'LIKE', '%' . $keyword . '%');
           })
           ->orWhere('comments', 'LIKE', '%'. $keyword .'%');
       }
        return $query;
    }

    
   
    public function scopeWhereCommentsInYear($query, $year = null)
    {
        if($year) {
            $dates = new CarbonImmutable();
            $start = $dates->setyear($year)->firstOfYear();
            $end = $start->endOfYear();
            $query->whereBetween('created_at', [$start, $end]);
        }
        return $query;
    }
    public function scopeWhereCommentsInMonth($query, $month = null)
    {
        if($month) {
            $dates = new CarbonImmutable();
            $start = $dates->setmonth($month)->firstOfMonth();
            $end = $start->endOfMonth();
            $query->whereBetween('created_at', [$start, $end]);
        }
        return $query;
    }
    public function scopeWhereCommentsInDay($query, $day = null)
    {
        if($day) {
            $dates = new CarbonImmutable();
            $start = $dates->setday($day)->startOfDay();
            $end = $start->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }
        return $query;
    }
}
