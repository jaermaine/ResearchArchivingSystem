<div class="mt-4 w-full flex items-center">
    <div class="mr-4">
        <select wire:model="selectedCategory" class="bg-[#FFC1C1] border-[#808080] outline-none focus:outline-none focus:ring-0 w-[130px] h-[55px]  px-4">
            <option value="">Any Field</option>
            <option value="title">By Title</option>
            <option value="author">By Author</option>
            <option value="department">By Department</option>
            <option value="date">By Date</option>
        </select>
    </div>

    <div class="flex items-center bg-[#FFC1C1] rounded-full h-[55px] w-full max-w-[800px] border-2 border-[#808080]">
    @if($selectedCategory === 'date')
        <input wire:model="searchInput" wire:keydown.enter="search" type="date" placeholder="Search..." class="bg-transparent border-none outline-none focus:outline-none focus:ring-0 placeholder-gray-500 flex-grow rounded-full h-full px-4" />
        @else
        <input wire:model="searchInput" wire:keydown.enter="search" type="text" placeholder="Search..." class="bg-transparent border-none outline-none focus:outline-none focus:ring-0 placeholder-gray-500 flex-grow rounded-full h-full px-4" />
        @endif

        <button wire:click="search" type="button" class="flex-none ml-1">
            <img src="{{ asset('img/search.png') }}" alt="Search" class="w-[45px] h-[45px] md:w-[45px] md:h-[45px]" />
        </button>   
    </div>
</div>
