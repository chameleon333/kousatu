<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

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
      return $this->Where('id', '<>', $user_id)->paginate(6);
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
      if(isset($params['binary_image']))
      {
        $img = $params["binary_image"];
        $fileData = base64_decode($img);
        $fileName = '/tmp/profile_image.png';
        file_put_contents($fileName, $fileData);

        $image = Storage::disk('s3')->putFile('/profile_images', $fileName, 'public');
        $image_path = Storage::disk('s3')->url($image);
        
        $this::where('id', $this->id)
          ->update([
            'screen_name' => $params['screen_name'],
            'name' => $params['name'],
            'self_introduction' => $params['self_introduction'],
            'profile_image' => $image_path,
            'email' => $params['email'],
          ]);
      } else {
        $this::where('id', $this->id)
          ->update([
            'screen_name' => $params['screen_name'],
            'name' => $params['name'],
            'self_introduction' => $params['self_introduction'],
            'email' => $params['email'],
          ]);
      }
      return;
    }

    public function getFollowingUsers($user_id)
    {
      return $this->follows()->where('following_id', $user_id)->paginate(6);
    }

    public function getFollowers($user_id)
    {
      return $this->followers()->where('followed_id', $user_id)->paginate(6);
    }

    public function getPopularUsers() {
      $favorite_list = Favorite::all();

      foreach($favorite_list as $favorite_item) {
        $user_id_list[] = $favorite_item->article()->value('user_id');
      }
      
      if(empty($user_id_list)) {
        $popular_users = [];
      } else {
        $rank_list = array_count_values($user_id_list);

        $rank_keys = array_keys($rank_list);
        $rank_keys = array_slice($rank_keys, 0, 5);
  
        $popular_users = $this->whereIn('id',$rank_keys)->get();
      }
      return $popular_users;
    }

    public function getTabInfoList(){
      $article = new Article();
      $follower = new Follower();
      $favorite = new Favorite();

      $user_id = $this->id;
      $follow_count = $follower->getFollowCount($user_id);
      $follower_count = $follower->getFollowerCount($user_id);
      $article_count = $article->getArticleCount($user_id);
      $favorite_count = $article->getFavoriteArticles($user_id)->total();

      $tab_info_list = [
        "投稿 ".$article_count => [
            "link" => "/users/{$user_id}",
        ],
        "フォロー ".$follow_count => [
            "link" => "/users/{$user_id}/following",
        ], 
        "フォロワー ".$follower_count => [
          "link" => "/users/{$user_id}/followers",
        ], 
        "いいねした記事 ".$favorite_count => [
          "link" => "/users/{$user_id}/favorite",
        ],
      ];

      return $tab_info_list;
    }

    public function getFollowStatuses($login_user) {
      if(isset($login_user)) {
        $follow_statuses["is_following"] = $login_user->isFollowing($this->id);
        $follow_statuses["is_followed"] = $login_user->isFollowed($this->id);  
      } else {
        $follow_statuses["is_following"] = false;
        $follow_statuses["is_followed"] = false;
      }

      return $follow_statuses;
    }

    public function getUserInfoList(){

      $follower = new Follower;
      $favorite = new Favorite;
      $article = new Article;

      $login_user = auth()->user();
      $follow_statuses = $this->getFollowStatuses($login_user);
      $total_favorited_count = $favorite->getTotalFavoritedCount($this->id);

      $user_info_list["user"] = $this;
      $user_info_list["total_favorited_count"] = $total_favorited_count;
      $user_info_list["is_following"] = $follow_statuses["is_following"];
      $user_info_list["is_followed"] = $follow_statuses["is_followed"];

      $user_info_list["tab_info_list"] = $this->getTabInfoList();


      return $user_info_list;
    }
}
