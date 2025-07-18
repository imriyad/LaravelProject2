<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    'title',
    'content',
    'views',
];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}