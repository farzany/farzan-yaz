@extends('layout')


@section('content')
    <article class="pb-7">
        <div id="details" class="mb-7 flex gap-5">
            <img src="/storage/profile-photo.jpg" alt="" class="w-16 my-auto rounded-full">
            <div class="text-md font-work flex flex-col justify-center">
                <p class="pt-0.5 font-merri font-semibold">Farzan Yazdanjou</p>
                <div class="flex flex-row">
                    <p class="dg">
                        {{ date('M jS Y', strtotime($post->created_at)); }}
                    </p>
                    <p class="px-2 dg">·</p>
                    <p class="dg"> {{ $post->getReadDuration()  }} min read </p>
                    <p class="px-2 dg">·</p>
                    <a class="text-sky-600 hover:underline" href="categories/{{$post->category->slug}}">{{ $post->category->name }}</a>
                </div>
            </div>
            {{-- Make share buttons --}}
            <div class="grow flex gap-2 pr-10 justify-end"> 
                {{-- <a href="https://www.linkedin.com/in/farzany/" target="__blank" class="fa fa-linkedin bg-slate-200 p-3 rounded hover:bg-slate-400 hover:text-white" title="LinkedIn"></a>
                <a href="https://www.instagram.com/farzany/" target="__blank" class="fa fa-twitter bg-slate-200 p-3 rounded" title="Instagram"></a>
                <a href="https://github.com/farzany" target="__blank" class="fa fa-facebook bg-slate-200 p-3 rounded" title="GitHub"></a> --}}
            </div>
        </div>
        <h1 class="font-bold text-[32px] leading-10 mb-5">
            {{ $post->title }}
        </h1>
        <div style="background-image: url('../storage/{{ $post->image }}')" class="w-full h-96 mb-5 bg-cover bg-center rounded-xl"></div>
        <p class="pl-5 border-l-4 dg text-xl font-work">
            {{ $post->subtitle }}
        </p>
        <div class="pt-8 body">
            {!! $post->body !!}
        </div>
    </article>
@endsection
