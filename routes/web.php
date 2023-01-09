<?php

use App\Models\Post;
use App\Models\Category;
use MailchimpMarketing\ApiClient;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\SitemapXmlController;
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

Route::get('posts', function () {
    return view('posts', [
        'posts' => Post::latest('created_at')->paginate(),
        'categories' => Category::all(),
        'metaTitle' => 'Posts - Farzan Yazdanjou',
        'metaDescription' => 'Hey! I post short articles about tech, programming tutorials, career discussions, and more. At least one a week - with an accompanying YouTube video.',
        'metaImage' => 'cover-photo.jpg',
    ]);
});

Route::get('posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post,
        'metaTitle' => "$post->title - Farzan Yazdanjou",
        'metaDescription' => $post->excerpt,
        'metaImage' => "posts/$post->image",
    ]);
});

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

Route::get('projects', function () {
    return view('projects', [
        'metaTitle' => 'Projects - Farzan Yazdanjou',
        'metaDescription' => '', // TODO
        'metaImage' => 'cover-photo.jpg',
    ]);
});

Route::post('newsletter', function () {

    request()->validate(['email' => 'required|email']);

    $mailchimp = new ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us17'
    ]);
    
    try {
        $mailchimp->lists->addListMember(config('services.mailchimp.list'), [
            'email_address' => request('email'),
            'status'        => 'pending',
        ]);
    } catch (Exception $e) {
        session()->flash('error', "The provided email address is invalid.");

        throw ValidationException::withMessages([
            'email' => 'The email must be a valid email address.',
        ]);
    }

    return redirect('posts')->with('success', "You've subscribed to the newsletter! Check your email to confirm.");
});

Route::get('sitemap.xml', [SitemapXmlController::class, 'index']);
Route::get('sitemap.xml/ping', [SitemapXmlController::class, 'ping']);

Route::get('resume-assistant', [ResumeAssistantController::class, 'index']);
Route::post('resume-assistant/create', [ResumeAssistantController::class, 'create']);
