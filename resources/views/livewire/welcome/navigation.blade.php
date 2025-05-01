<nav class="flex flex-1 justify-end items-center space-x-6">
    @auth
        <livewire:menu-dropdown />
    @else
        <div class="flex items-center space-x-4">
            <a href="{{ route('login') }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:text-[#800000] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#800000] focus:ring-offset-2 rounded-lg">
                Log in
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="px-5 py-2.5 text-sm font-medium text-white bg-[#800000] hover:bg-red-700 shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#800000] focus:ring-offset-2 rounded-lg">
                    Register
                </a>
            @endif
        </div>
    @endauth
</nav>