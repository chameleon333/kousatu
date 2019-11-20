<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
      'body'
    ];
  
    public function account()
    {
      return $this->belongTo(Account::class);
    }
  
    public function favorites()
    {
      return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }
}
