<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'caption' , 'photo',
    ];
    public function user()
    {
        $this->belongsTo('App\User');
    }
    
}
