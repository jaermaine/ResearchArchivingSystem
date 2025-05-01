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
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- FIXED HEADER - always stays at top -->
        <div class="w-full bg-white fixed top-0 left-0 right-0 p-2 z-20" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
            <div class="container mx-auto px-2 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="/welcome" class="text-xl font-bold text-[#b30000]">
                            <img class="w-[190px] h-[70px] sm:w-[260px] sm:h-[90px]" src="{{ asset('img/lpuc-logo.png') }}" alt="LPU Logo" />
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full sm:max-w-xl mt-20 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

        <!-- FIXED FOOTER -->
        <div class="fixed bottom-0 left-0 right-0 py-4 bg-white text-center text-sm text-black z-10" style="box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
            Cloud-Based Research Archiving Systems: A Design Framework for Scalable Repositories
        </div>
    </div>
</body>

</html>