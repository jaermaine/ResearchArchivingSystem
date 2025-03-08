<div class="relative inline-block" x-data="{ open: false, selectedItem: localStorage.getItem('selectedItem') || 'Menu' }">
    <!-- Menu Button -->
    <button @mouseenter="open = true" @mouseleave="open = false"
            class="bg-[#b30000] text-white px-4 py-2 rounded-lg hover:bg-red-800 ml-0"
            style="width: 150px; height: 50px;">
        <span x-text="selectedItem" class="truncate"></span> 
    </button>

    <!-- Dropdown Menu -->
    <div @mouseenter="open = true" @mouseleave="open = false"
         x-show="open" x-transition
         class="absolute left-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg z-50">

        <a href="/welcome" @click="localStorage.setItem('selectedItem', 'Home'); selectedItem = 'Home'; open = false" 
           class="block px-4 py-2 hover:bg-gray-200 font-['ZapfHumnst-BT']">Home</a>
        <hr class="my-1">
        <a href="/dashboard" @click="localStorage.setItem('selectedItem', 'My Documents'); selectedItem = 'My Documents'; open = false" 
           class="block px-4 py-2 hover:bg-gray-200 font-['ZapfHumnst-BT']">My Documents</a>
        <a href="/settings" @click="localStorage.setItem('selectedItem', 'Profile Settings'); selectedItem = 'Profile Settings'; open = false" 
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