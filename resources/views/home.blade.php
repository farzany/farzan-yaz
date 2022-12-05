@extends('layout')


@section('content')
    <div class="home">
        <h2 class="text-center text-3xl font-semibold font-work p-3">
            Hello there! 👋🏼
        </h2>
        <h1 class="text-center text-3xl font-semibold font-work p-3 pt-0 mb-2">
            I'm Farzan Yazdanjou, a Computer Science student at McMaster University.
        </h1>
        <p class="dg text-xl font-work text-center mb-5">I'm currently interning at Coconut Software as a Software Developer! 🥥🌴</p>
        <div style="background-image: url('/storage/cover-photo.jpg')" class="banner mb-10 w-full h-96 bg-cover bg-center rounded-2xl"></div>
        <div>
            <p class="body mb-3">
                I'm a third year student at McMaster University studying Computer Science. As a full-stack programmer, I am passionate about web-app development! For more information about my academic career, please visit my LinkedIn profile!
            </p>
            <p class="body mb-5">
                I have 3000 hours on CSGO, which basically makes me a professional gamer. I love biking through trails and the city and photographing the scenary. I've watched the Iron Man trilogy countless times. I'm always listening to music - my favorite song is Mutual Butterflies by Ryan Trey. I've lost my fair share of money gambling on Cryptocurrency. As one does, I of course also love memes.
            </p>
        </div>
        <div>
            <h2 class="text-xl font-work mb-2">CHECK OUT WHAT I'M LISTENING TO ✨</h2>
            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/4wNpNCgwh82TcUzK3CT5Sn?utm_source=generator" width="100%" height="80" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
        </div>
        <hr class="mb-7 mt-12 border-1 border-dg">
        <div class="">
            <h2 class="font-work text-3xl text-center">Latest Blog Post</h2>
            <x-post-card :post="$post" />
        </div>
        <hr class="my-10 border-1 border-dg">
        {{-- <h2 class="text-sky-700 text-2xl font-work mb-2">Projects</h2>
        <p class="body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, atque perferendis. Aut, dolorum praesentium. Dolores magnam commodi quas! Amet hic quaerat suscipit sunt blanditiis aut cumque eos quisquam aspernatur quis?
        </p> --}}
    </div>
@endsection