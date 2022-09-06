<?php

namespace App\Http\Controllers;

use App\Models\CreatedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CreatedPostController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'posts' => CreatedPost::latest()->with(['author'])->where('author_id' , auth()->id())->get()
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'text' => 'required'
            // 'image' => 'mimes:jpeg,bmp,png'
        ]);

        $attributes['author_id'] = auth()->id();

        CreatedPost::create($attributes);

        return redirect(route('myUnpublishedPosts'));
    }

    public function show(CreatedPost $createdPost)
    {
        return Inertia::render('Posts/PostShow', [
            'post' => $createdPost::with('Author')->where('id' , $createdPost->id)->get()
        ]);
    }

    public function edit(CreatedPost $createdPost)
    {
        if($createdPost->author_id === auth()->id())
        {
            return Inertia::render('Posts/PostEdit', [
                'post' => $createdPost
            ]);
        }

        return Redirect::route('myUnpublishedPosts');
    }

    public function update(CreatedPost $createdPost , Request $request)
    {

        $attributes = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'text' => 'required'
            // 'image' => 'mimes:jpeg,bmp,png'
        ]);
        $createdPost->update($attributes);
        return redirect(route('myUnpublishedPosts'));
    }

    public function destroy(CreatedPost $createdPost)
    {
        $createdPost->delete();
        return redirect(route('myUnpublishedPosts'));
    }
}
