@props(['project'])

{{-- ToDo! This is simply a rough boilerplate --}}

<article id="project" class="my-7 py-7 border-t border-db">
    <div id="description">
        <h2 class="font-bold text-2xl leading-7">
            {{ $project->title }}
        </h2>
        <p class="text-xl pt-3">
            {{ $project->description }}
        </p>
    </div>
</article>