<?php

namespace App;
use App\Mail\BareMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PasswordResetNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use Notifiable;
    
    use softDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token, new BareMail()));
    }


    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows' , 'followee_id', 'follower_id')->withTimestamps();
    }
    public function followees()
    {
        return $this->belongsToMany(User::class , 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }
    public function isFollowedBy(?User $user)
    {
        return $user 
               ? (bool) $this->followers->where('id' , $user->id)->count()
               : false;
    }
    public function getCountFollowersAttribute()
    {
        return $this->followers->count();
    }
    public function getCountFolloweesAttribute()
    {
        return $this->followees->count();
    }
    public function postLikes() :BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes');
    }
    public function getCountAllLikesAttribute()
    {
        return $this->postLikes->count();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
