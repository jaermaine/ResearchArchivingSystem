<div class="w-full max-w-7xl mx-auto">
    <!-- Search Results Container -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h1 class="text-2xl font-bold text-gray-800">Search Results</h1>
            @if(count($searchResults) > 0)
            <p class="text-gray-500 mt-1">Found {{ $searchResults->total() }} {{ Str::plural('result', $searchResults->total()) }}</p>
            @endif
        </div>

        @if(count($searchResults) > 0)
        <div class="divide-y divide-gray-100">
            @foreach($searchResults as $result)
            <div class="ml-10 group p-6 hover:bg-gray-50 transition-all duration-200">
                <div class="flex flex-col space-y-4">
                    <!-- Title with hover effect -->
                    <h2 class="text-xl font-bold text-gray-800 group-hover:text-[#800000] transition-colors duration-200">
                        {{ $result->title }}
                    </h2>

                    <div class="flex flex-col md:flex-row md:items-center md:space-x-6 text-sm">
                        <!-- Author information with improved design -->
                        <div class="flex items-center text-gray-600 mb-2 md:mb-0">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-500 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="font-medium">{{ $result->authors }}</span>
                        </div>

                        <!-- Date information -->
                        <div class="flex items-center text-gray-500">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-500 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span>{{ \Carbon\Carbon::parse($result->created_at)->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <!-- Read More Button -->
                    <div class="pt-2">
                        <a href="{{ route('document-info', ['id' => $result->id]) }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#800000] hover:bg-[#600000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#800000] transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            View Full Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Enhanced Pagination Links -->
        <div class="px-6 py-4 divide-y divide-gray-100">
            {{ $searchResults->appends(request()->query())->links() }}
        </div>
        @else
        <!-- Improved Empty State -->
        <div class="p-16 text-center">
            <div class="bg-gray-50 inline-flex items-center justify-center w-20 h-20 rounded-full mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No results found</h3>
            <p class="text-gray-500 max-w-md mx-auto">We couldn't find any documents that match your search criteria. Try adjusting your search terms or filters.</p>

            <div class="mt-6">
                <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#800000]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Search
                </a>
            </div>
        </div>
        @endif
    </div>
</div>