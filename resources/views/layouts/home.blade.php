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
                <div class="w-full bg-white fixed top-0 left-0 right-0 z-10" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
                    <div class="container mx-auto px-2 py-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <a href="/welcome" class="text-xl font-bold text-[#b30000]">
                                    <img class="w-[230px] h-[90px]" src="img/lpuc-logo.png" alt="LPU Logo" />
                                </a>
                            </div>
                            <!-- You can add navigation or other header elements here -->
                            @if (Route::has('login'))
                                <livewire:welcome.navigation />
                            @endif
                        </div>
                    </div>
                </div>

                <!-- SEARCH BAR -->
                <div>
                    <livewire:search-field />
                </div>

                <!-- Browsing on Mobile -->
                <header class="flex lg:hidden flex-col items-center py-4 w-full">
                    <div class="flex items-center justify-between w-full px-4">
                        <div class="w-[60px] h-[60px] flex items-center justify-center">
                            <a href="/welcome">
                                <img class="w-[60px] h-[60px]" src="img/LPU logo.png" alt="LPU Logo" />
                            </a>
                        </div>
                        <div class="flex space-x-4 text-red-500">
                            @if (Route::has('login'))
                                <livewire:welcome.navigation />
                            @endif
                        </div>
                    </div>
                    <div>
                        <livewire:search-field />
                    </div>
                </header>

                <main class="mt-6">
                    <div class="container">
                        @yield('content')
                    </div>
                </main>

                <footer class="fixed bottom-0 left-0 right-0 py-4 bg-white text-center text-sm text-black" style="box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
                    Cloud-Based Research Archiving Systems: A Design Framework for Scalable Repositories
                </footer>

            </div>
        </div>
    </div>
</body>

</html>
