@props(['post'])

<a href="/posts/{{ $post->slug }}" class="">
    <article class="post my-7 p-5 rounded-2xl flex gap-5 justify-between outline-2 hover:outline outline-db bg-cyan-50">
        <div class="flex justify-center flex-col w-2/3">
            <p class="pb-1 dg text-sm font-work">
                {{ date('M jS Y', strtotime($post->created_at)); }}
                <span class="px-1">·</span>
                {{ $post->category->name }}
                <span class="px-1">·</span>
                {{ $post->getReadDuration() }} min read
            </p>
            <h2 class="font-bold text-[1.4rem]">
                    {{ $post->title }}
            </h2>
            <div class="pt-1 text-base line-clamp-2">
                {{ $post->excerpt }}
            </div>
        </div>
        <div style="background-image: url('/storage/{{ $post->image }}')" class="thumbnail shrink-0 w-48 h-27 bg-center rounded-xl"></div>
    </article>
</a>