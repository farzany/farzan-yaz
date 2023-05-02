<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Displays a view of all posts.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function all()
    {
        return view('posts', [
            'posts' => cache()->remember("posts", now()->addDays(5), function () {
                return Post::latest('created_at')->paginate();
            }),
            'categories' => Category::all(),
            'metaTitle' => 'Posts - Farzan Yazdanjou',
            'metaDescription' => 'Hey! I post short articles about tech, programming tutorials, career discussions, and more. At least one a week - with an accompanying YouTube video.',
            'metaImage' => 'cover-photo.jpg',
        ]);
    }

    /**
     * Displays a view of a single post.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        return view('post', [
            'post' => cache()->remember("posts.{$post->slug}", now()->addDay(), function () use ($post) {
                return $post;
            }),
            'metaTitle' => "$post->title - Farzan Yazdanjou",
            'metaDescription' => $post->excerpt,
            'metaImage' => "posts/$post->image",
        ]);
    }
}
