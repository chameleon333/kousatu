<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      'text'
    ];
  
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function getComments(Int $article_id)
    {
      return $this->with('user')->where('article_id', $article_id)->get();
    }

    public function commentStore(Int $user_id, Array $data)
    {
      $this->user_id = $user_id;
      $this->article_id = $data['article_id'];
      $this->text = $data['text'];
      $this->save();
      return;
    }
}
