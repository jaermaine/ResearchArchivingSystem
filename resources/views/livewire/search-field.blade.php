<div class="w-full max-w-4xl px-4 py-8">
    <form wire:submit.prevent="search" class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
        <div class="flex flex-col md:flex-row p-4 gap-4">
            <!-- Category Dropdown -->
            <div class="w-full md:w-1/3">
                <select wire:model="selectedCategory"
                    class="w-full h-12 px-4 rounded-lg bg-gray-50 border border-gray-200 text-gray-700 focus:ring-2 focus:ring-[#800000] focus:border-transparent transition-all duration-200">
                    <option value="">Any Field</option>
                    <option value="title">By Title</option>
                    <option value="author">By Author</option>
                    <option value="keyword">By Keyword</option>
                    <option value="program">By Program</option>
                    <option value="date">By Year</option>
                </select>
            </div>

            <!-- Search Bar -->
            <div class="relative flex-grow">
                <div class="flex items-center h-12 w-full rounded-lg bg-gray-50 border border-gray-200 group focus-within:ring-2 focus-within:ring-[#800000] focus-within:border-transparent transition-all duration-200">
                    @if($selectedCategory === 'date')
                    <input wire:model="searchInput"
                        class="bg-transparent border-none focus:ring-0 focus:outline-none placeholder-gray-400 flex-grow h-full px-4 text-gray-700"
                        type="number"
                        placeholder="Enter year..."
                        min="1900"
                        max="{{ date('Y') }}" />
                    @else
                    <input wire:model="searchInput"
                        type="text"
                        placeholder="Search documents..."
                        class="bg-transparent border-none focus:ring-0 focus:outline-none placeholder-gray-400 flex-grow h-full px-4 text-gray-700" />
                    @endif

                    <!-- Search Button -->
                    <button type="submit"
                        class="h-full px-5 bg-[#800000] text-white rounded-r-lg transition-colors duration-200 hover:bg-red-700 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Search indication label -->
    @if(!empty($searchInput))
    <div class="mt-3">
        <div class="bg-[#800000] bg-opacity-10 text-[#800000] px-4 py-2 rounded-full text-sm inline-block">
            Searching: {{ $selectedCategory ? ucfirst($selectedCategory) . ' - ' : '' }} "{{ $searchInput }}"
        </div>
    </div>
    @endif
</div>