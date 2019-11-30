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
}
