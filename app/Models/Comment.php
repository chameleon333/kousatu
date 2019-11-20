<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      'text'
    ];
  
    public function account()
    {
      return $this->belongsTo(Account::class);
    }
}
