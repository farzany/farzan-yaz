@extends('layout')


@section('content')
    <article class="post pb-7">
        <div id="details" class="mb-7 flex gap-5">
            <img src="/storage/profile-photo.jpg" alt="" class="profile-photo w-16 my-auto rounded-full">
            <div class="text-md font-work flex flex-col justify-center">
                <p class="pt-0.5 font-merri font-semibold">Farzan Yazdanjou</p>
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
        <h1 class="title font-bold text-[32px] leading-10 mb-5">
            {{ $post->title }}
        </h1>
        <div style="background-image: url('../storage/{{ $post->image }}')" class="banner w-full h-96 mb-5 bg-cover bg-center rounded-xl"></div>
        <p class="subtitle pl-3 border-l-2 dg text-xl font-work">
            {{ $post->subtitle }}
        </p>
        <div class="pt-8 body">
            {!! $post->body !!}
        </div>
    </article>
@endsection
