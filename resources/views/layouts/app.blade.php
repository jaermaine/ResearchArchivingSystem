<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use App\Models\Documents;

new class extends Component
{
    public string $title = '';
    public string $abstract = '';
    public string $faculty = '';
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function submit(): void
    {
        $document = Documents::create([
            'title' => $this->title,
            'abstract' => $this->abstract,
            'faculty' => $this->faculty,
        ]);
    }
}; ?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="COECSA Archive" />
    <link rel="manifest" href="/site.webmanifest" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-50 text-black/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <!-- Browsing on Desktop -->
                <header class="hidden lg:grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="w-[100px] h-[100px] flex-col justify-center items-center inline-flex md:w-[154px] md:h-[171px] hidden md:flex">
                        <img class="w-[100px] h-[100px] md:w-[154px] md:h-[171px]" src="img/LPU logo.png" alt="LPU Logo" />
                    </div>

                    <div class="w-full flex items-center bg-[#FFC1C1] rounded-full w-[500px] h-[55px] md:w-[500px] md:h-[55px]">
                        <input type="text" placeholder="Search..." class="bg-transparent border-none outline-none focus:outline-none focus:ring-0 placeholder-gray-500 flex-grow" />
                        <button type="submit" class="ml-2">
                            <img src="img/search.png" alt="Search" class="w-[1px] h-[1px] md:w-[45px] md:h-[40px]" />
                        </button>
                    </div>

                    <div class="flex items-center justify-end">
                        <form method="POST" action="/logout" class="flex space-x-4 text-red-500">
                            @csrf
                            <button type="submit" class="hover:underline">Log Out</button>
                        </form>
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

                        <!-- Profile -->
                        <div class="flex items-center justify-end">
                            <form method="POST" action="/logout" class="flex space-x-4 text-red-500">
                                @csrf
                                <button type="submit" class="hover:underline">Log Out</button>
                            </form>
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

                    @yield('table')

                    @yield('button')

                </main>

                <footer class="py-16 text-center text-sm text-black">
                    Cloud-Based Research Archiving Systems: A Design Framework for Scalable Repositories
                </footer>
            </div>
        </div>
    </div>
</body>

</html>