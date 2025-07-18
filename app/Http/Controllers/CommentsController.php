<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $req)
    {

        //dd($req->all());

        $validate=$req->validate([
            'post_id' => 'required|exists:posts,id',
        'author_name' => 'required|string|max:255',
        'comment_text' => 'required|string',
        ]);

        $comment=new Comment;

        $comment->post_id=$req->post_id;
                $comment->author_name=$req->author_name;
                        $comment->comment_text=$req->comment_text;

        $comment->save();

        return redirect()->route('home')->with('success','Your Comment has been added!');


    }

    public function seeComments($id)
    {
        $post = Post::with('comments')->findOrFail($id);

        return view('posts.show', ['post' => $post]);
    }
}