<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use App\Models\Documents;

new class extends Component
{
    public string $title = '';
    public string $abstract = '';
    public string $adviser = '';
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </link>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
            document.getElementById('title').value = '';
            document.getElementById('abstract').value = '';
            document.getElementById('field_topic').value = '';
            document.getElementById('adviser').value = '';
        }
    </script>
</head>

<body class="font-sans antialiased" style="background-image: url('/background.png'); background-size: cover; background-position: center;">
    <div class="text-black/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#C91F37] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <!-- Browsing on Desktop -->
                <header class="hidden lg:grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="w-[100px] h-[100px] flex-col justify-center items-center inline-flex md:w-[154px] md:h-[171px] hidden md:flex">
                        <a href="/welcome">
                            <img href="home" class="w-[100px] h-[100px] md:w-[154px] md:h-[171px]" src="img/LPU logo.png" alt="LPU Logo" />
                        </a>
                    </div>

                    <div></div>

                    <div class="flex items-center justify-end ">
                        <livewire:menu-dropdown />
                    </div>
                </header>
                l
                <!-- Browsing on Mobile -->
                <header class="flex lg:hidden flex-col items-center py-4 w-full">

                    <!-- Top row with LPU Logo and Login/Register links -->
                    <div class="flex items-center justify-between w-full px-4">
                        <!-- LPU LOGO on the left -->
                        <div class="w-[60px] h-[60px] flex items-center justify-center">
                            <a href="/welcome">
                                <img class="w-[60px] h-[60px]" src="img/LPU logo.png" alt="LPU Logo" />
                            </a>
                        </div>

                        <!-- Profile -->
                        <div class="flex items-center justify-end">
                            <div class="flex space-x-4">
                                <livewire:menu-dropdown />
                            </div>
                        </div>
                    </div>
                </header>

                <main class="mt-6">
                    <div class="container mx-auto p-6">
                        <!-- Main Wrapper with border -->
                        <div class="flex flex-col md:flex-row gap-6 border-2 border-[#b30000] rounded-lg p-6" style="background-color: rgba(255, 255, 255, 0.9);">

                            @yield('content')

                            @yield('button')
                        </div>

                </main>
            </div>
        </div>
    </div>
</body>

<footer class="py-16 text-center text-sm text-black">
    Cloud-Based Research Archiving Systems: A Design Framework for Scalable Repositories
</footer>

</html>