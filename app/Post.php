<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'caption',
        'profile_photo',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
