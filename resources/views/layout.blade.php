<!doctype html>

<head>
    @vite('resources/css/app.css')
    @vite('resources/css/prism.css')
    @vite('resources/js/app.js')
    @vite('resources/js/prism.js')
    <meta charset="UTF-8">
    <meta name="description" content="{{ $metaDescription ?? '' }}">
    <meta property="og:image" content="{{ "../storage/$metaImage" }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/storage/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/storage/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/storage/favicon/favicon-16x16.png">
    <link rel="manifest" href="/storage/favicon/site.webmanifest">
    <link rel="mask-icon" href="/storage/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Scripts and Symbols -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script async src="https://static.addtoany.com/menu/page.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://apis.google.com/js/platform.js"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,400&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:ital,wght@0,300;0,400;0,600;0,700;0,900;1,300;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"/>
</head>

<title> {{ $metaTitle ?? 'Farzan Yazdanjou' }} </title>

<body>
    <header class="bg-db2 text-center">
        <a href="/">
            <span class="header text-3xl font-bold font-merri leading-[55px] text-white">
                Farzan Yazdanjou
            </span>
        </a>
    </header>
    <div class="wrapper">
        <div class="">
            <nav class="navigation flex font-work text-base text-lg mt-5 justify-center">
                <a href="/" class="hover:shadow rounded-xl {{Request::path() === '/' ? 'text-db2' : 'text-gray-400'}}">
                    Home
                </a>
                <a href="/posts" class="hover:shadow rounded-xl {{Request::path() === 'posts' ? 'text-db2' : 'text-gray-400'}}">
                    Posts
                </a>
                <a href="/resume" class="hover:shadow rounded-xl {{Request::path() === 'resume' ? 'text-db2' : 'text-gray-400'}}">
                    Resume
                </a>
                <a href="/projects" class="hover:shadow rounded-xl {{Request::path() === 'projects' ? 'text-db2' : 'text-gray-400'}}">
                    Projects
                </a>
            </nav>
        </div>
        <div class="mt-5 mb-12">
            @yield('content')
        </div>
    </div>
    <footer class="h-[250px] relative text-center bg-[#f0f0f0]">
        <h2 class="font-merri text-2xl font-bold pt-8 pb-2 text-db">
            Farzan Yazdanjou
        </h2>
        <p class="font-work text-db">
            Software Developer
        </p>
        <div class="social-media flex justify-center gap-5 py-6"> 
            <a href="https://www.linkedin.com/in/farzany/" target="__blank" class="fa fa-linkedin" title="LinkedIn"></a>
            <a href="https://github.com/farzany" target="__blank" class="fa fa-github" title="GitHub"></a>
            <a href="https://www.youtube.com/@farzany" target="__blank" class="fa fa-youtube-play" title="YouTube"></a>
            <a href="https://www.instagram.com/farzany/" target="__blank" class="fa fa-instagram" title="Instagram"></a>
        </div>
        <p class="font-work text-dg">
            © {{ date("Y") }} Farzan Yazdanjou
        </p>
    </footer>

    <x-snack-bar />
</body>