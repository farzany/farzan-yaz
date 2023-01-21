@extends('layout')

@section('content')
    <div class="posts">
        <div>
            <div class="flex gap-5">
                <div class="description">
                    <h1 class="font-bold text-[32px] leading-10">
                        Blog Posts
                    </h1>
                    <p class="text-xl pt-2">
                        I post short articles about technology, programming tutorials and tips, career discussions, and more. I aim to post at least once a week - with an accompanying YouTube video for each post. If video content intrigues you more, check out my <a href="https://www.youtube.com/@farzany" target="_blank" class="font-semibold text-red-400 hover:underline">YouTube channel</a>!
                    </p>
                </div>
                <img class="posts grow flex-grow w-32" src="/storage/connected-globe.svg" alt="">
            </div>
            <div class="flex gap-5 pt-7 flex-wrap">
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
        <div>
            @if ($posts->isNotEmpty())
                @foreach ($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
                <div class="pagination">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="w-full h-96 flex items-center flex-col justify-center">
                    <h2 class="text-3xl text-gray-400">No posts, yet...</h2>
                </div>
            @endif
        </div>
        <x-newsletter />
    </div>
@endsection
