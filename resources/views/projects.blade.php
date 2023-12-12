@extends('layout')

@section('content')
    <div id="projects">
        <div class="flex gap-5">
            <div class="description">
                <h1 class="font-bold text-[32px] leading-10">
                    Projects
                </h1>
                <p class="text-xl pt-2">
                    I believe that there is no better way to learn programming than diving into projects! Here are some of my notable projects - if you're interested in learning more about any of them, feel free to connect with me. All of my projects are open-source, so you can explore them on my <a href="https://github.com/farzany" target="__blank" class="inline" title="GitHub">GitHub</a>!
                </p>
            </div>
            <img class="header flex-grow w-40 -mr-8" src="/storage/server-rack.svg" alt="">
        </div>
        <div id="projects">
            @if ($projects->isNotEmpty())
                @foreach ($projects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            @else
                <div class="w-full h-96 flex items-center flex-col justify-center">
                    <h2 class="text-3xl text-gray-400">No projects, yet...</h2>
                </div>
            @endif
        </div>
    </div>
@endsection
