<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home Page</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans">
        <div class="bg-gray-50 text-black/50">

        <!-- FIXED HEADER - always stays at top -->
        <div class="w-full bg-white fixed top-0 left-0 right-0 p-2 z-20" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
            <div class="container mx-auto px-2 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="/welcome" class="text-xl font-bold text-[#b30000]">
                            <img class="w-[190px] h-[70px] sm:w-[260px] sm:h-[90px]" src="{{ asset('img/lpuc-logo.png') }}" alt="LPU Logo" />
                        </a>
                    </div>
                    @if (Route::has('login'))
                    <livewire:welcome.navigation />
                    @endif
                </div>
            </div>
        </div>

        <!-- SEARCH BAR - scrolls with the page -->
        <div class="w-full bg-gray-50 relative top-[120px] sm:top-[150px] sm:left-[140px] right-0 z-10 py-4">
            <div class="container mx-auto">
                <livewire:search-field />
            </div>
        </div>

        <!-- MAIN CONTENT - scrollable area with appropriate padding -->
        <div class="container mx-auto pt-[180px] sm:pt-[200px] pb-16 md:w-[1250px] overflow-hidden">
            @yield('content')
        </div>

        <!-- FIXED FOOTER -->
        <div class="fixed bottom-0 left-0 right-0 py-4 bg-white text-center text-sm text-black z-10" style="box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
            Cloud-Based Research Archiving Systems: A Design Framework for Scalable Repositories
        </div>
    </div>
</body>

</html>
