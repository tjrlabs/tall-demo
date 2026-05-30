<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function show()
    {
        $post = Post::firstOrFail();

        return view('posts.show', compact('post'));
    }
}
