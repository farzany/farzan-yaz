@extends('layout')

@section('content')
    <div>
        <h1 class="font-bold text-[32px] leading-10">
            Blog Posts
        </h1>
        <p class="text-xl pt-2">
            Take a look at some of the blog posts that I've written! Some of the technical ones have an accompanying YouTube video going over the same content.
        </p>
    </div>
    @foreach ($posts as $post)
        <a href="/posts/{{ $post->slug }}" class="trasition ease-in-out hover:-translate-y-1 hover:scale-110">
            <article class="post my-7 p-5 rounded-2xl flex gap-5 justify-between bg-sky-50">
                <div class="flex justify-center flex-col w-2/3">
                    <p class="pb-1 dg text-sm font-work">{{ date('M jS Y', strtotime($post->created_at)); }}</p>
                    <h2 class="font-bold text-[1.4rem]">
                            {{ $post->title }}
                    </h2>
                    <div class="pt-1 text-base line-clamp-2">
                        {{ $post->excerpt }}
                    </div>
                </div>
                <div style="background-image: url('storage/{{ $post->image }}')" class="thumbnail shrink-0 w-48 h-27 bg-center rounded-xl"></div>
            </article>
        </a>
    @endforeach
@endsection
