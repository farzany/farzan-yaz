<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SitemapXmlController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ResumeAssistantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        'post' => Post::latest('created_at')->first(),
        'metaTitle' => 'Farzan Yazdanjou',
        'metaDescription' => "Hello! I'm Farzan Yazdanjou, a CS student at McMaster University interning as a full-stack developer. I create content about programming and technology.",
        'metaImage' => 'cover-photo.jpg',
    ]);
});

Route::get('posts', [PostController::class, 'all']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('posts/categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts()->latest('created_at')->paginate(),
        'categories' => Category::all(),
        'metaTitle' => "$category->name Posts - Farzan Yazdanjou",
        'metaDescription' => 'Hey! I post short articles about tech, programming tutorials, career discussions, and more. At least one a week - with an accompanying YouTube video.',
        'metaImage' => 'cover-photo.jpg',
    ]);
});

Route::get('resume', function () {
    return view('resume', [
        'metaTitle' => 'Resume - Farzan Yazdanjou',
        'metaDescription' => '', // TODO
        'metaImage' => 'cover-photo.jpg',
    ]);
});

Route::get('projects', [ProjectController::class, 'all']);

Route::post('newsletter', [NewsletterController::class, 'create']);

Route::get('sitemap.xml', [SitemapXmlController::class, 'index']);
Route::get('sitemap.xml/ping', [SitemapXmlController::class, 'ping']);

Route::get('resume-assistant', [ResumeAssistantController::class, 'index']);
Route::post('resume-assistant/create', [ResumeAssistantController::class, 'create']);
