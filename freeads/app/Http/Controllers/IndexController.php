<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Post;

class IndexController extends Controller
{
    protected function showIndex()
    {
        $posts = Post::with('photos')->orderby('posts.created_at', 'desc')->get();
        return view('index')->with('posts' ,$posts);
    }
}