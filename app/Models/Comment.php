<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments'; 
    protected $fillable = ['post_id', 'author_name', 'comment_text'];

    public function post()
    {
        return $this->belongsTo(post::class);
    }
}