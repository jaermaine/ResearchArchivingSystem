<div class="relative inline-block" x-data="{ open: false }">
    <!-- Menu Button -->
    <button @mouseenter="open = true" @mouseleave="open = false" 
        class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
        Menu
    </button>

    <!-- Dropdown Menu -->
    <div @mouseenter="open = true" @mouseleave="open = false"
        x-show="open" x-transition 
        class="absolute left-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg z-50">
        
        <a href="/welcome" class="block px-4 py-2 hover:bg-gray-200">Home</a>
        <hr class="my-1">
        <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-200">My Documents</a>
        <a href="/settings" class="block px-4 py-2 hover:bg-gray-200">Profile Settings</a>
        <hr class="my-1">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-200">
                Log out
            </button>
        </form>
    </div>
</div>

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
