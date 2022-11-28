<!doctype html>

<head>
    @vite('resources/css/app.css')
    <!-- Scripts and Symbols -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script async src="https://static.addtoany.com/menu/page.js"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,400&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:ital,wght@0,300;0,400;0,600;0,700;0,900;1,300;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&display=swap" rel="stylesheet">
</head>

<title>Farzan Yaz</title>

<body>
    <header class="bg-db2 text-center">
        <span class="text-3xl font-bold font-merri leading-[55px] text-white">
            Farzan Yazdanjou
        </span>
    </header>
    <div class="wrapper">
        {{-- TODO: Redo navigation and remove it from post view --}}
        <div class="">
            <nav class="flex font-work text-base border-b-2 text-lg mt-10">
                <a href="/" class="mr-5 pb-4 border-b-2 -mb-0.5 {{Request::path() === '/' ? 'db' : ''}} hover:font-semibold">
                    Home
                </a>
                <a href="/posts" class="mr-5 pb-4 border-b-2 -mb-0.5 {{Request::path() === 'posts' ? 'db' : ''}} hover:font-semibold">
                    Posts
                </a>
            </nav>
        </div>
        <div class="mt-5 mb-12">
            @yield('content')
        </div>
    </div>
    <footer class="h-[250px] relative text-center bg-[#f0f0f0]">
        <h2 class="font-merri text-2xl font-bold pt-8 pb-2 text-db2">
            Farzan Yazdanjou
        </h2>
        <p class="font-work">
            Software Developer
        </p>
        <div class="social-media flex justify-center gap-5 py-6"> 
            <a href="https://www.linkedin.com/in/farzany/" target="__blank" class="fa fa-linkedin" title="LinkedIn"></a>
            <a href="https://github.com/farzany" target="__blank" class="fa fa-github" title="GitHub"></a>
            <a href="https://www.youtube.com/channel/UCvrcJLLb73nSfFRurmGUQuQ" target="__blank" class="fa fa-youtube-play" title="YouTube"></a>
            <a href="https://www.instagram.com/farzany/" target="__blank" class="fa fa-instagram" title="Instagram"></a>
        </div>
        <p class="font-work text-dg">
            © 2022 Farzan Yazdanjou
        </p>
    </footer>
</body>