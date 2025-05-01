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
    @livewireScripts
</head>

<body class="font-sans text-gray-900 antialiased" style="background-image: url('img/BG - REGISTER.png'); background-size: cover; background-position: center;">
    <!-- FIXED HEADER -->
    <div class="w-full bg-white fixed top-0 left-0 right-0 p-1 z-20" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
        <div class="container mx-auto px-3">
            <div class="flex items-center h-12">
                <a href="/welcome" class="text-xl font-bold text-[#b30000]">
                    <img class="h-10 w-auto sm:h-10" src="{{ asset('img/lpuc-logo.png') }}" alt="LPU Logo" />
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex flex-col">

        <!-- Content Container - Reduced padding -->
        <div class="flex-1 flex items-center justify-center px-4 py-6 sm:py-8">
            <div class="w-full max-w-md sm:max-w-lg">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- FIXED FOOTER -->
    <div class="fixed bottom-0 left-0 right-0 py-3 bg-white text-center text-sm text-black z-10" style="box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
        Cloud-Based Research Archiving Systems: A Design Framework for Scalable Repositories
    </div>
</body>

</html>