<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.addEventListener('load', function() {
            if (document.querySelector('meta[name="csrf-token"]')) {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
            }
        });
    </script>

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="COECSA Archive" />
    <link rel="manifest" href="/site.webmanifest" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased" style="background-image: url('img/BG - REGISTER.png'); background-size: cover; background-position: center;">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="flex space-x-4"> <!-- Add 'flex' and 'space-x-4' for side-by-side alignment with spacing -->
            <a href="/welcome" wire:navigate>
                <img class="w-[125px] h-[125px] md:w-[165px] md:h-[171px]" src="img/LPU logo.png" alt="LPU Logo" /> <!-- LPU LOGO -->
            </a>
            <a href="/welcome" wire:navigate>
                <img class="w-[125px] h-[125px] md:w-[185px] md:h-[171px]" src="img/coecsa.png" alt="COECSA Logo" /> <!-- COECSA LOGO -->
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>