<div class="mt-4 w-full px-4 w-full flex items-center bg-[#FFC1C1] rounded-full w-[500px] h-[55px] md:w-[500px] md:h-[55px]">
    <input wire:model="searchInput" wire:keydown.enter="search" type="text" placeholder="Search..." value="" class="bg-transparent border-none outline-none focus:outline-none focus:ring-0 placeholder-gray-500 flex-grow" />
    <button wire:click="search" type="submit" class="ml-2">
        <img src="{{ asset('img/search.png') }}" alt="Search" class="w-[25px] h-[25px] md:w-[25px] md:h-[25px]" />
    </button>
</div>