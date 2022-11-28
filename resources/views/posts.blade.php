@extends('layout')

@section('content')
    @foreach ($posts as $post)
        <a href="/posts/{{ $post->id }}" class="trasition ease-in-out hover:-translate-y-1 hover:scale-110">
            <article class="my-7 {{ $loop->first ? 'mt-12' : null}} p-5 rounded-2xl flex gap-5 justify-between bg-sky-50 hover:outline outline-db">
                <div class="flex justify-center flex-col w-2/3">
                    <p class="pb-2 dg text-sm font-work">{{ date('M jS Y', strtotime($post->created_at)); }}</p>
                    <h2 class="font-bold text-[1.4rem]">
                            {{ $post->title }}
                    </h2>
                    <div class="pt-1 text-base line-clamp-2">
                        {{ $post->excerpt }}
                    </div>
                </div>
                <div class="shrink-0 w-48 h-27 bg-[url('{{ $post->image }}')] bg-cover bg-center rounded-xl"></div>
            </article>
        </a>
    @endforeach
@endsection
