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
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <!-- Browsing on Desktop -->
                <header class="hidden lg:grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">

                    <!-- LOGIN & REGISTER -->
                    <div class="flex lg:justify-center lg:col-start-2 hidden md:flex">
                    </div>
                    @if (Route::has('login'))
                    <livewire:welcome.navigation />
                    @endif

                    <!-- LPU LOGO -->
                    <div class="w-[100px] h-[100px] flex-col justify-center items-center inline-flex md:w-[154px] md:h-[171px] hidden md:flex">
                        <a href="/welcome">
                            <img class="w-[100px] h-[100px] md:w-[154px] md:h-[171px]" src="{{ asset('img/LPU logo.png') }}" alt="LPU Logo" />
                        </a>
                    </div>

                    <!-- SEARCH BAR -->
                    <div>
                        <livewire:search-field />
                    </div>

                </header>

                <!-- Browsing on Mobile -->
                <header class="flex lg:hidden flex-col items-center py-4 w-full">

                    <!-- Top row with LPU Logo and Login/Register links -->
                    <div class="flex items-center justify-between w-full px-4">
                        <!-- LPU LOGO on the left -->
                        <div class="w-[60px] h-[60px] flex items-center justify-center">
                            <a href="/welcome">
                                <img class="w-[60px] h-[60px]" src="{{ asset('img/LPU logo.png') }}" alt="LPU Logo" />
                            </a>
                        </div>

                        <!-- LOGIN & REGISTER links on the right -->
                        <div class="flex space-x-4 text-red-500">
                            @if (Route::has('login'))
                            <livewire:welcome.navigation />
                            @endif
                        </div>
                    </div>

                    <!-- Search bar below logo and links -->
                    <div>
                        <div>
                            <livewire:search-field />
                        </div>
                    </div>

                </header>


                <main class="mt-6">
                    <div class="container">
                        @yield('content')
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black">
                    Cloud-Based Research Archiving Systems: A Design Framework for Scalable Repositories
                </footer>
            </div>
        </div>
    </div>
</body>

</html>