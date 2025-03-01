<nav class="-mx-3 flex flex-1 justify-end space-x-4">
    @auth
    <a
        href="{{ url('/dashboard') }}"
        class="rounded-md px-3 py-2 text-lg sm:text-2xl font-['ZapfHumnst-BT'] text-[#C91F37] ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-red-500">
        Dashboard
    </a>

    <a
        href="{{ url('/settings') }}"
        class="rounded-md px-3 py-2 text-lg sm:text-2xl font-['ZapfHumnst-BT'] text-[#C91F37] ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-red-500">
        Settings
    </a>

    @else
    <a
        href="{{ route('login') }}"
        class="rounded-md px-3 py-2 text-lg sm:text-2xl font-['ZapfHumnst-BT'] text-[#C91F37] ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
        Log in
    </a>

    @if (Route::has('register'))
    <a
        href="{{ route('register') }}"
       class="rounded-md px-3 py-2 text-lg sm:text-2xl font-['ZapfHumnst-BT'] text-[#C91F37] ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
        Register
    </a>
    @endif
    @endauth
</nav>