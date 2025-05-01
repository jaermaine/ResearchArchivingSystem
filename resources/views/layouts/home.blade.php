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
    <div class="min-h-screen bg-gray-50 text-black/50 flex flex-col">

        <!-- FIXED HEADER - responsive for all devices -->
        <div class="w-full bg-white fixed top-0 left-0 right-0 z-20" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
            <div class="container mx-auto px-4 py-2">
                <div class="flex items-center justify-between relative">
                    <div class="flex items-center">
                        <a href="/welcome" class="text-xl font-bold text-[#b30000]">
                            <img class="w-[120px] h-auto sm:w-[150px] md:w-[190px]" src="{{ asset('img/lpuc-logo.png') }}" alt="LPU Logo" />
                        </a>
                    </div>
                    @if (Route::has('login'))
                    <livewire:welcome.navigation />
                    @endif
                </div>
            </div>
        </div>



        <!-- SEARCH BAR - responsive positioning -->
        @if (Route::currentRouteName() != 'document-info')
        <div class="w-full bg-gray-50 pt-[80px] sm:pt-[100px] md:pt-[120px] pb-4 px-4">
            <div class="container mx-auto max-w-6xl">
                <livewire:search-field />
            </div>
        </div>
        @endif

        <!-- MAIN CONTENT - responsive container -->
        <div class="flex-grow container mx-auto px-4 pt-4 pb-16 sm:pb-20 @if(Route::currentRouteName() == 'document-info') pt-[80px] sm:pt-[100px] md:pt-[120px] @endif">
            @yield('content')
        </div>

        <!-- FIXED FOOTER - responsive for all devices -->
        <div class="fixed bottom-0 left-0 right-0 py-3 sm:py-4 bg-white text-center text-xs sm:text-sm text-black z-10" style="box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
            <div class="container mx-auto px-4">
                Cloud-Based Research Archiving Systems: A Design Framework for Scalable Repositories
            </div>
        </div>
    </div>


</body>

</html>