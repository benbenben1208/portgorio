<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'user_id',
        'group_id',
        'message',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
