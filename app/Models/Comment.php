<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model 
{
	protected $fillable = ['author', 'text', 'article_id'];


    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}
