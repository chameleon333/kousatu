<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email', 
        'password',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];
//
//    /**
//     * The attributes that should be cast to native types.
//     *
//     * @var array
//     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
  
    public function followers()
    {
      return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }
  
    public function follows()
    {
      return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }
  
    public function getAllUsers($user_id)
    {
      return $this->Where('id', '<>', $user_id)->paginate(5);
    }
  
    public function follow($user_id)
    {
      return $this->follows()->attach($user_id);
    }
  
    public function unfollow($user_id)
    {
      return $this->follows()->detach($user_id);
    }
  
    public function isFollowing($user_id)
    {
//      return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
//      $debug = $this->follows()->where('followed_id',$user_id)->first(['user_id']);
//      \Debugbar::info($debug);
      \Debugbar::info($this->follows());
//      \Debugbar::info($user_id);
      \Debugbar::info("user_id");
      
//      return (boolean) $this->follows()->where('followed_id',$user_id)->first(['user_id']);
      return (boolean) $this->follows()->where ('followed_id', $user_id);
    }
  
    public function isFollowed($user_id)
    {
      
//      return (boolean) $this->followers()->where('following_id',$user_id)->first(['id']);
//      $debug = $this->followers()->where('following_id',$user_id);
//      \Debugbar::info($debug);
//      return (boolean) $this->followers()->where('following_id',$user_id)->first(['user_id']);
      return (boolean) $this->followers()->where('following_id',$user_id);
    }
}
