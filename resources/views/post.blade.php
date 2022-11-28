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
                </div>
            </div>
            {{-- Make share buttons --}}
            <div class="grow flex gap-2 pr-10 justify-end"> 
                {{-- <a href="https://www.linkedin.com/in/farzany/" target="__blank" class="fa fa-linkedin bg-slate-200 p-3 rounded hover:bg-slate-400 hover:text-white" title="LinkedIn"></a>
                <a href="https://www.instagram.com/farzany/" target="__blank" class="fa fa-twitter bg-slate-200 p-3 rounded" title="Instagram"></a>
                <a href="https://github.com/farzany" target="__blank" class="fa fa-facebook bg-slate-200 p-3 rounded" title="GitHub"></a> --}}
            </div>
        </div>
        <div style="background-image: url('../storage/{{ $post->image }}')" class="w-full h-96 mb-7 bg-cover bg-center rounded-xl"></div>
        <h1 class="font-bold text-[32px] leading-10">
            {{ $post->title }}
        </h1>
        <p class="pt-3 dg text-xl font-work">
            {{ $post->subtitle }}
        </p>
        <div class="pt-5 body">
            {!! $post->body !!}
        </div>
    </article>
@endsection
