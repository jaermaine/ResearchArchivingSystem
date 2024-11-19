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
                        <img class="w-[100px] h-[100px] md:w-[154px] md:h-[171px]" src="img/LPU logo.png" alt="LPU Logo" />
                    </div>

                    <!-- SEARCH BAR -->
                    <div class="w-full flex items-center bg-[#FFC1C1] rounded-full w-[500px] h-[55px] md:w-[500px] md:h-[55px]">
                        <input type="text" placeholder="Search..." class="bg-transparent border-none outline-none focus:outline-none focus:ring-0 placeholder-gray-500 flex-grow" />
                        <button type="submit" class="ml-2">
                            <img src="img/search.png" alt="Search" class="w-[1px] h-[1px] md:w-[45px] md:h-[40px]" />
                        </button>
                    </div>

                </header>

                <!-- Browsing on Mobile -->
                <header class="flex lg:hidden flex-col items-center py-4 w-full">

                    <!-- Top row with LPU Logo and Login/Register links -->
                    <div class="flex items-center justify-between w-full px-4">
                        <!-- LPU LOGO on the left -->
                        <div class="w-[60px] h-[60px] flex items-center justify-center">
                            <img class="w-[60px] h-[60px]" src="img/LPU logo.png" alt="LPU Logo" />
                        </div>

                        <!-- LOGIN & REGISTER links on the right -->
                        <div class="flex space-x-4 text-red-500">
                            <a href="{{ route('login') }}" class="hover:underline">Log in</a>
                            <a href="{{ route('register') }}" class="hover:underline">Register</a>
                        </div>
                    </div>

                    <!-- Search bar below logo and links -->
                    <div class="mt-4 w-full px-4">
                        <div class="flex items-center bg-[#FFC1C1] rounded-full h-[45px]">
                            <input type="text" placeholder="Search..." class="bg-transparent border-none outline-none focus:outline-none focus:ring-0 placeholder-gray-500 flex-grow px-4" />
                            <button type="submit" class="ml-2 pr-4">
                                <img src="img/search.png" alt="Search" class="w-[25px] h-[25px]" />
                            </button>
                        </div>
                    </div>

                </header>


                <main class="mt-6">
                    <div class="grid gap-6 lg:grid-cols-1 lg:gap-8">

                        <a
                            id="docs-card"
                            class="flex flex-col lg:flex-row items-start gap-4 p-6 bg-white rounded-md shadow-lg ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20]">

                            <!-- Image Container (Hidden on mobile) -->
                            <div class="w-[210px] h-[434px] bg-[#ff3333] rounded-md flex items-center justify-center hidden lg:flex">
                                <img class="w-[172px] h-[172px]" src="img/coecsa.png" alt="COECSA Logo" />
                            </div>

                            <!-- Text Container (Visible on all screen sizes) -->
                            <div class="flex flex-col justify-start items-start">
                                <br>
                                <br>
                                <br>
                                <div class="text-black text-3xl font-semibold font-['Inter'] leading-9">Introduction</div>
                                <div class="text-[#ff3333] text-lg font-semibold font-['Inter'] leading-7 mt-2">
                                    LPU Cavite-Archium is a Research Archiving System that aims to centralize the submission process and streamline the archiving of documents
                                </div>
                                <br>
                                <br>
                                <br>
                                <!-- Getting Started Section -->
                                <div class="text-black text-3xl font-semibold font-['Inter'] leading-9">Getting Started</div>
                                <div class="text-[#ff3333] text-lg font-semibold font-['Inter'] leading-7 mt-2">
                                    Sign-in/Register to access full features
                                </div>
                            </div>

                        </a>

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
