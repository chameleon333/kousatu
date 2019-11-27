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
        'screen_name',
        'name',
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
  
    public function follow(Int $user_id)
    {
      return $this->follows()->attach($user_id);
    }
  
    public function unfollow(Int $user_id)
    {
      return $this->follows()->detach($user_id);
    }
  
    public function isFollowing(Int $user_id)
    {
      return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }
  
    public function isFollowed(Int $user_id)
    {
      return (boolean) $this->followers()->where('following_id',$user_id)->first(['id']);
    }
  
    public function updateProfile(Array $params)
    {
      if(isset($params['profile_image']))
      {
        $file_name = $params['profile_image']->store('public/profile_image/');
        
        $this::where('id', $this->id)
          ->update([
            'screen_name' => $params['screen_name'],
            'name' => $params['name'],
            'profile_image' => basename($file_name),
            'email' => $params['email'],
          ]);
      } else {
        $this::where('id', $this->id)
          ->update([
            'screen_name' => $params['screen_name'],
            'name' => $params['name'],
            'email' => $params['email'],
          ]);
      }
      return;
    }
}
