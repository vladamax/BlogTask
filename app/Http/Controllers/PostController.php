<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CreatedPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        if (Route::currentRouteName() === 'home') {
            $posts = Post::latest()->with(['author', 'comments'])->get();
        } else {
            $posts = Post::latest()->with(['author', 'comments'])->where('author_id', auth()->id())->get();
        }
        return Inertia::render('Welcome', [
            'posts' => $posts
        ]);
    }


    public function show(Post $post)
    {
        return Inertia::render('Posts/PostShow', [
            'post' => $post::with('Author')->where('id', $post->id)->get(),
            'comments' => Comment::latest()->with('Author')->where('post_id', $post->id)->get(),
            'can' => [
                'comment' => Auth::check()
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Posts/CreatePost');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'text' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
        ]);
        $attributes['author_id'] = auth()->id();

        if (request()->file()) {
            $image = request()->file('image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('/images'), $image_name);
            $attributes['image'] = '/images/' . $image_name;
        }
        
        Post::create($attributes);

        if (str_starts_with(substr(url()->previous(), 21), '/unpublishedPosts/'))
            return redirect('/unpublishedPostsDelete/' . substr(url()->previous(), 39));

        return redirect(route('myPosts'));
    }

    public function edit(Post $post)
    {
        if ($post->author_id === auth()->id()) {
            return Inertia::render('Posts/PostEdit', [
                'post' => $post
            ]);
        }
        return Redirect::route('myPosts');
    }

    public function update(Post $post, Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'text' => 'required'
            // 'image' => 'mimes:jpeg,bmp,png'
        ]);

        $post->update($attributes);
        return redirect(route('myPosts'));
    }

    public function destroy(Post $post)
    {
        if ($post->author_id === auth()->id()) {
            $post->delete();
        }
        return redirect()->back();
    }
}
