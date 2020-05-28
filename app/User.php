<?php

namespace App;
use App\Mail\BareMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PasswordResetNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class User extends Authenticatable
{
    public static function boot()
    {
        parent::boot();

        self::deleting(function ($user) {
            foreach($user->posts as $post) {
                $post->delete();
            }
            foreach($user->comments as $comment) {
                $comment->delete();
            }
            // foreach($user->likes as $like) {
            //     $like->delete();
            // }
            
            foreach($user->followers as $follower ) {
                $follower->delete();
            }
            // foreach($user->folowee as $folowee) {
            //     $folowee->delete();
            // }
           
        });
       
    }
    use Notifiable;
    
    use softDeletes;
    
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
    public function scopeWhereNameFilter($query, $name = null)
    {
        if ($name) {
           
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        return $query;
    }
    
    public function scopeWherePeriod($query, $period = null)
    {
        if ($period) {
            if (strpos($period, 'hour')) {
                $period = intval(substr($period, 0, 1));
                $query->where('created_at', '>', Carbon::now()->subHours($period));
                
            }
            
            if (strpos($period, 'week')) {
                $period = intval(substr($period, 0, 1));
                 $query->where('created_at', '>', Carbon::now()->subWeeks($period));
            }
            if (strpos($period, 'month')) {
                $period = intval(substr($period, 0, 1));
                $query->where('created_at', '>', Carbon::now()->subMonths($period));
                
            }
        }
        return $query;
    }
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
    
}
