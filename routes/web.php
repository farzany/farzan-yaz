<?php

use App\Models\Post;
use App\Models\Category;
use MailchimpMarketing\ApiClient;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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
        'metaDescription' => "Hello there! 👋🏼 I'm Farzan Yazdanjou, a Computer Science student at McMaster University. I'm interning at Coconut Software as a Software Developer! 🥥🌴",
    ]);
});

Route::get('posts', function () {
    return view('posts', [
        'posts' => Post::latest('created_at')->paginate(),
        'categories' => Category::all(),
        'metaTitle' => 'Posts - Farzan Yazdanjou',
        'metaDescription' => 'Hey! 👋🏼 I post short articles about tech, programming tutorials, career discussions, and more. At least one a week - with an accompanying YouTube video.',
    ]);
});

Route::get('posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post,
        'metaTitle' => "$post->title - Farzan Yazdanjou",
        'metaDescription' => $post->excerpt,
    ]);
});

Route::get('posts/categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts()->latest('created_at')->paginate(),
        'categories' => Category::all(),
        'metaTitle' => "$category->name Posts - Farzan Yazdanjou",
        'metaDescription' => 'Hey! 👋🏼 I post short articles about tech, programming tutorials, career discussions, and more. At least one a week - with an accompanying YouTube video.',
    ]);
});

Route::get('resume', function () {
    return view('resume', [
        'metaTitle' => 'Resume - Farzan Yazdanjou',
        'metaDescription' => '', // TODO
    ]);
});

Route::get('projects', function () {
    return view('projects', [
        'metaTitle' => 'Projects - Farzan Yazdanjou',
        'metaDescription' => '', // TODO
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