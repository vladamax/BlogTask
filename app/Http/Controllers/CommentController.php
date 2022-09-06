<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'post_id' => 'required',
            'text' => 'required'
            // 'image' => 'mimes:jpeg,bmp,png'
        ]);

        $attributes['comment_author_id'] = auth()->id();

        Comment::create($attributes);

        return Redirect::back();
    }
}
