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

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
  
    public function getUserTimeLine(Int $user_id, $status_id)
    {
      return $this->where('user_id', $user_id)->where('status', $status_id)->orderBy('created_at', 'DESC')->paginate(50);
    }
  
    public function getArticleCount(Int $user_id)
    {
      return $this->where('user_id', $user_id)->count();
    }
  
    public function getTimeLines(Int $status_id)
    {
      //全ての記事を取得する
      return $this->where('status', $status_id)->orderBy('created_at', 'DESC')->paginate(6);
    }

    public function getFollowedTimeLines(Int $user_id, Array $follow_ids)
    {
      //自身とフォローしているユーザーを結合する
      $follow_ids[] = $user_id;
      return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    }

    public function getArticle(Int $article_id)
    {
      return $this->with('user')->where('id', $article_id)->first();
    }

    public function articleStore(Int $user_id, Array $data)
    {
      $this->user_id = $user_id;
      $this->header_image = $data['binary_image'];
      $this->title = $data['title'];
      $this->body = $data['body'];
      $this->status = $data['article_status_id'];
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
      $this->status = $data['article_status_id'];
      $this->update();
      return;
    }

    public function articleDestroy(Int $user_id, Int $article_id)
    {
      return $this->where('user_id',$user_id)->where('id',$article_id)->delete();
    }

    public function articleTagStore(Array $tag_ids){
      foreach($tag_ids as $tag_id) {
        $this->tags()->attach($tag_id);
      }
    }

    public function articleTagSync(Array $tag_ids){
        $this->tags()->sync($tag_ids);
    }

    public function getPostArticleStatusTexts() {
      $article_status_texts = ["kousatuに投稿する","下書きに保存する"];
      $article_status_texts = json_encode($article_status_texts);

      return $article_status_texts;
    }

}
