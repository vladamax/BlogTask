<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CreatedPostController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::post('/uploadFile', [FileController::class, 'upload']);

Route::middleware('auth')->group(function () {
    Route::post('/createdComment', [CommentController::class, 'store'])->name('storeComment');

    Route::controller(CreatedPostController::class)->group(function () {
        Route::get('/unpublishedPosts', 'index')->name('myUnpublishedPosts');
        Route::post('/createUnpublishedPost', 'store')->name('storeUnpublishedPosts');
        Route::get('/unpublishedPostsDelete/{createdPost}', 'destroy');
        Route::get('/unpublishedPostsEdit/{createdPost}', 'edit')->name('editUnpublishedPost');
        Route::post('/unpublishedPostsUpdate/{createdPost}', 'update');
        Route::get('/unpublishedPosts/{createdPost}', 'show')->name('unpublishedPostsShow');
    });

    Route::controller(PostController::class)->group(function () {
        Route::get('/myPosts', 'index')->name('myPosts');
        Route::get('/createPost', 'create')->name('createPost');
        Route::post('/createdPost', 'store')->name('storePost');
        Route::get('/postsEdit/{post}', 'edit');
        Route::post('/postsUpdate/{post}', 'update');
        Route::get('/postsDelete/{post}', 'destroy');
    });
});


require __DIR__ . '/auth.php';
