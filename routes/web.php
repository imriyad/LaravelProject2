<?php

use App\Models\post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\GoogleController;


Route::get('/', function () {
    return view('welcome',['posts'=>post::paginate(5)]);
})->name('home');

Route::get('/about', function () {
    return view('about.index',["name"=>"Mahdi"]);
});

Route::get('/create',[PostController::class,'create']);

Route::post('/store',[PostController::class,'fileStore'])->name('store');

Route::get('/edit/{id}',[PostController::class,'editData'])->name('edit');

Route::post('/update/{id}',[PostController::class,'updateData'])->name('update');

Route::get('/delete/{id}',[PostController::class,'deleteData'])->name('delete');

Route::get('/details/{id}',[PostController::class,'detailsData'])->name('details');

Route::post('/comment', [CommentsController::class, 'store'])->name('comments.store');

Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');


Route::get('/posts/{id}/comments', [CommentsController::class, 'seeComments'])->name('posts.comments');

Route::get('/posts/{id}/clicked', [PostController::class, 'incrementClicked'])->name('posts.incrementClicked');

Route::get('/search', [PostController::class, 'search'])->name('posts.search');

Route::get('/teas',function()
{
    $teas=[
        ["name"=>"Mashala Chai","price"=>100,"id"=>1],
        ["name"=>"Ginger Chai","price"=>110,"id"=>2],

        ["name"=>"Assam Chai","price"=>150,"id"=>3],

    ];

    return view('teas.index',['teas'=>$teas]);
});


Route::get('/teas/{id}',function($id)
{
    $teas=[
        ["name"=>"Mashala Chai","price"=>100,"id"=>1],
        ["name"=>"Ginger Chai","price"=>110,"id"=>2],

        ["name"=>"Assam Chai","price"=>150,"id"=>3],

    ];

    return view('teas.teadetails',['tea'=>$teas[$id-1]]);
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard',['posts'=>post::paginate(5)]);
    })->name('dashboard');
});

Route::get('auth/google',[GoogleController::class,'googlePage']);

Route::get('auth/google/callback',[GoogleController::class,'googleCallBack']);

// adding some comments for checking