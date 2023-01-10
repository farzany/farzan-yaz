<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function all()
    {
        return view('posts', [
            'posts' => Post::latest('created_at')->paginate(),
            'categories' => Category::all(),
            'metaTitle' => 'Posts - Farzan Yazdanjou',
            'metaDescription' => 'Hey! I post short articles about tech, programming tutorials, career discussions, and more. At least one a week - with an accompanying YouTube video.',
            'metaImage' => 'cover-photo.jpg',
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post,
            'metaTitle' => "$post->title - Farzan Yazdanjou",
            'metaDescription' => $post->excerpt,
            'metaImage' => "posts/$post->image",
        ]);
    }
}
