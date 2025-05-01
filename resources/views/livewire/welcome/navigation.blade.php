<nav x-data="{ mobileMenuOpen: false }" class="flex flex-1 justify-end items-center">
    @auth
        <!-- Desktop Menu -->
        <div class="hidden md:block">
            <livewire:menu-dropdown />
        </div>

        <!-- Mobile Menu Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg text-gray-600 hover:text-[#800000]">
            <svg class="h-6 w-6" x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg class="h-6 w-6" x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    @else
        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-4">
            <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:text-[#800000] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#800000] focus:ring-offset-2 rounded-lg">
                Log in
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-medium text-white bg-[#800000] hover:bg-red-700 shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#800000] focus:ring-offset-2 rounded-lg">
                    Register
                </a>
            @endif
        </div>

        <!-- Mobile Menu Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg text-gray-600 hover:text-[#800000]">
            <svg class="h-6 w-6" x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg class="h-6 w-6" x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    @endauth

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="absolute top-full right-0 left-0 bg-white shadow-lg mt-2 py-2 md:hidden">
        @auth
            <!-- Authenticated Mobile Menu -->
            <div class="px-4 py-3 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 rounded-full overflow-hidden">
                        @include('layouts/profile-picture', ['user' => Auth::user()])
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>
            <a href="/welcome" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#800000]">Home</a>
            @if(Auth::user()->role != 'admin')
                <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#800000]">My Documents</a>
                <a href="/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#800000]">Profile Settings</a>
            @else
                <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#800000]">Dashboard</a>
            @endif
            <form method="POST" action="/logout" class="border-t border-gray-100">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                    Log out
                </button>
            </form>
        @else
            <!-- Guest Mobile Menu -->
            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#800000]">
                Log in
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#800000]">
                    Register
                </a>
            @endif
        @endauth
    </div>
</nav>