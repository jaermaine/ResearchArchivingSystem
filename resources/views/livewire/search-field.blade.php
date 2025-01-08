<div class="mt-4 w-full flex flex-col md:flex-row items-center md:space-x-4 space-y-4 md:space-y-0">
    <form wire:submit.prevent="search" class="flex w-full flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
        
        <!-- Category Dropdown -->
        <select wire:model="selectedCategory" 
                class="bg-[#FFC1C1] border-[#808080] outline-none focus:ring-0 w-full md:w-[170px] h-[50px] px-4 rounded-lg">
            <option value="">Any Field</option>
            <option value="title">By Title</option>
            <option value="author">By Author</option>
            <option value="department">By Dept</option>
            <option value="date">By Year</option>
        </select>

        <!-- Search Bar -->
        <div class="flex items-center bg-[#FFC1C1] rounded-full h-[50px] w-full border-2 border-[#808080]">
            @if($selectedCategory === 'date')
                <input wire:model="searchInput"
                       class="bg-transparent border-none focus:ring-0 focus:outline-none placeholder-gray-500 flex-grow h-full px-4 rounded-full" />
            @else
                <input wire:model="searchInput" type="text" placeholder="Search..."
                       class="bg-transparent border-none focus:ring-0 focus:outline-none placeholder-gray-500 flex-grow h-full px-4 rounded-full" />
            @endif

            <!-- Search Button -->
            <button type="submit" class="flex items-center justify-center p-2">
                <img src="{{ asset('img/search.png') }}" alt="Search" class="w-[35px] h-[35px]" />
            </button>
        </div>
    </form>
</div>
