@extends('layout')

@section('content')
    <div>
        <div class="flex gap-5">
            <div>
                <h1 class="font-bold text-[32px] leading-10">
                    Blog Posts
                </h1>
                <p class="text-xl pt-2">
                    Take a look at some of the blog posts that I've written! Some of the technical ones have an accompanying YouTube video going over the same content.
                </p>
            </div>
            <img class="posts grow flex-grow w-32" src="/storage/connected-globe.svg" alt="">
        </div>
        <div class="flex gap-5 pt-7">
            <a class="px-5 py-1  font-work rounded-xl {{Request::path() === "posts" ? 'text-white bg-db' : 'bg-gray-100 text-gray-600'}}" href="/posts">
                All
            </a>
            @foreach ($categories as $category)
                <a class="px-3 py-1  font-work rounded-xl {{Request::path() === "posts/categories/$category->slug" ? 'text-white bg-db' : 'bg-gray-100 text-gray-600'}}" href="/posts/categories/{{$category->slug}}">
                    {{$category->name}}
                </a>
            @endforeach
        </div>
    </div>
    @foreach ($posts as $post)
        <x-post-card :post="$post" />
    @endforeach
    <div class="pagination">
        {{ $posts->links() }}
    </div>
@endsection
