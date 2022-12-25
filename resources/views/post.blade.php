@extends('layout')


@section('content')
    <article class="post">
        <div id="details" class="mb-7 flex gap-5 bg-sky-100/75 rounded-xl">
            <img src="/storage/profile-photo.jpg" alt="" class="profile-photo w-16 my-auto rounded-xl p-1">
            <div class="text-md font-work flex flex-col justify-center">
                <p class="author pt-0.5 text-lg leading-6">Farzan Yazdanjou</p>
                <div class="info flex flex-row">
                    <p class="dg date-long">
                        {{ date('M jS Y', strtotime($post->created_at)); }}
                    </p>
                    <p class="dg date-short">
                        {{ date('M jS', strtotime($post->created_at)); }}
                    </p>
                    <p class="dot px-2 dg">·</p>
                    <p class="dg"> {{ $post->getReadDuration()  }} min read </p>
                    <p class="dot px-2 dg">·</p>
                    <a class="text-sky-600 hover:underline" href="categories/{{$post->category->slug}}">{{ $post->category->name }}</a>
                </div>
            </div>
            {{-- Make share buttons --}}
        </div>
        <h1 class="title font-bold text-4xl leading-10 mb-5">
            {{ $post->title }}
        </h1>
        @if ($post->video)
            <a href="{{ $post->video }}" target="_blank">
                <button class="font-bold text-lg bg-red-400 mb-5 px-3 py-1 text-white rounded-xl hover:bg-red-500">
                    Watch this post on YouTube
                </button>
            </a>
        @endif
        <img class="mb-5 rounded-xl" src="../storage/posts/{{ $post->image }}" alt="{{ $post->title }} - Farzan Yazdanjou">
        <p class="subtitle pl-3 border-l-2 dg text-xl font-work">
            {{ $post->subtitle }}
        </p>
        <div class="pt-8 body">
            {!! $post->body !!}
        </div>
    </article>
    <x-post-ending />
    <x-newsletter />
@endsection
