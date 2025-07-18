<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('create.index');
    }

    public function fileStore(Request $req){

        $validated =$req->validate([
            'title'=>'required',
            'content'=>'required',
        ]);
        $post=new Post;

        $post->title=$req->title;
        $post->content=$req->content;

       $post->save();
        
       return redirect()->route('home')->with('success','Your post has been created!');

    }

    public function editData($id)
    {
        $post=Post::findOrFail($id);
        return view('edit.index',['myPost'=>$post]);

    }

    public function updateData($id,Request $req)
    {
        
         $validated =$req->validate([
            'title'=>'required',
            'content'=>'required',
        ]);

        $post=Post::findOrFail($id);
        $post->title=$req->title;
        $post->content=$req->content;

       $post->save();

       return redirect()->route('home')->with('success','Your post has been updated!');


    }

    public function deleteData($id)
    {
        $post=Post::findOrFail($id);

        $post->delete();

        return redirect()->route('home')->with('success','Your post has been deleted!');

    }

    public function detailsData($id)
{
    $post = Post::findOrFail($id);

    // Increment view count
    $post->increment('views');

    return view('details.index', ['post' => $post]);
}

public function incrementClicked($id)
{
    $post = Post::findOrFail($id);
    $post->increment('clicked');

    // Redirect to details or wherever you want
    return redirect()->route('details', $id);
}

public function search(Request $request)
{
    $query = $request->input('query');
    $words = explode(' ', $query); // split the query into words

    $posts = Post::query()
        ->where(function ($q) use ($words) {
            foreach ($words as $word) {
                $q->orWhere('title', 'like', "%{$word}%")
                  ->orWhere('content', 'like', "%{$word}%");
            }
        })
        ->select('*')
        ->selectRaw('COALESCE(views,0) + COALESCE(clicked,0) as score')
        ->orderByDesc('score')
        ->paginate(10)
        ->appends(['query' => $query]);
        
    return view('posts.search_results', compact('posts', 'query'));

}

}