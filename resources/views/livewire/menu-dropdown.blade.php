<div class="relative inline-block" x-data="{ open: false }">
    <!-- Menu Button -->
    <button @mouseenter="open = true" @mouseleave="open = false"
        class="bg-[#b30000] text-white px-4 py-2 rounded-lg hover:bg-red-800 ml-0
               w-[80px] h-[50px] sm:w-[150px] sm:h-[60px] font-['ZapfHumnst-BT']">
        Menu
    </button>

    <!-- Dropdown Menu -->
    <div @mouseenter="open = true" @mouseleave="open = false"
        x-show="open" x-transition
        class="absolute left-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg z-50">

        <a href="/welcome"
            class="block px-4 py-2 hover:bg-gray-200 font-['ZapfHumnst-BT']">Home</a>
        <hr class="my-1">
        <a href="/dashboard"
            class="block px-4 py-2 hover:bg-gray-200 font-['ZapfHumnst-BT']">My Documents</a>
        <a href="/settings"
            class="block px-4 py-2 hover:bg-gray-200 font-['ZapfHumnst-BT']">Profile Settings</a>
        <hr class="my-1">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-200 font-['ZapfHumnst-BT']">
                Log out
            </button>
        </form>
    </div>
</div>

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>