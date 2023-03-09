@props(['project'])

<article id="project" class="shadow-md my-7 rounded-2xl flex flex-col gap-5 justify-between bg-gray-800">
    <div id="image" style="background-image: url('/storage/projects/{{ $project->image }}')" class="bg-cover bg-center w-full h-48 rounded-t-2xl" onclick="toggleDescription()"></div>
    <div id="description" class="p-5 pt-0">
        <h2 class="text-white font-bold text-3xl leading-7 pt-2">
            {{ $project->title }}
        </h2>
        <p class="text-white text-lg pt-3">
            {{ $project->description }}
        </p>
        <div id="actions" class="flex justify-between gap-3 pt-5">
            <div class="social-media flex justify-center gap-5 items-center">
                <a href="{{ $project->source }}" target="__blank" class="fa fa-github !p-0 !w-10 !h-10 !text-[42px] !text-white" title="Source Code"></a>
                <a href="{{ $project->video }}" target="__blank" class="fa fa-youtube-play !p-0 !w-10 !h-10 !text-[42px] !text-white" title="YouTube Video"></a>
            </div>
            <a href="{{ $project->demo }}">
                <button type="button" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-work rounded-lg text-md px-5 py-2.5 text-center inline-flex items-center">
                    Try it out!
                    <svg aria-hidden="true" class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </a>
        </div>
    </div>
</article>
