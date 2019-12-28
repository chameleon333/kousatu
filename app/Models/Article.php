<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\softDeletes;

class Article extends Model
{
    // use SoftDeletes;

    protected $fillable = [
      'title',
      'body'      
    ];
  
    public function user()
    {
      return $this->belongsTo(User::class);
    }
  
    public function favorites()
    {
      return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }
  
    public function getUserTimeLine(Int $user_id)
    {
      return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
    }
  
    public function getArticleCount(Int $user_id)
    {
      return $this->where('user_id', $user_id)->count();
    }
  
    public function getTimeLines()
    {
      //全ての記事を取得する
      return $this->orderBy('created_at', 'DESC')->paginate(5);
    }

    public function getFollowedTimeLines(Int $user_id, Array $follow_ids)
    {
      //自身とフォローしているユーザーを結合する
      $follow_ids[] = $user_id;
      // dd($this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50));
      return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    }

    public function getArticle(Int $article_id)
    {
      return $this->with('user')->where('id', $article_id)->first();
    }

    public function articleStore(Int $user_id, Array $data)
    {
      $this->user_id = $user_id;
      $this->title = $data['title'];
      $this->body = $data['body'];
      $this->save();

      return;
    }

    public function getEditArticle(Int $user_id, Int $article_id)
    {
      return $this->where('user_id', $user_id)->where('id', $article_id)->first();
    }

    public function articleUpdate(Int $article_id, Array $data)
    {
      $this->id = $article_id;
      $this->title = $data['title'];
      $this->body = $data['body'];
      $this->update();

      return;
    }

    public function uploadImage(Array $params)
    {
        if(isset($params['image_url']))
        {
          $file_name = $params['image_url']->store('public/post_image');
        }
        return basename($file_name);
    }

    public function articleDestroy(Int $user_id, Int $article_id)
    {
      return $this->where('user_id',$user_id)->where('id',$article_id)->delete();
    }

}
