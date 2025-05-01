<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header with back button -->
        <div class="px-6 pt-6 border-b border-gray-200 flex items-center justify-between">
            <a class="inline-flex items-center text-gray-600 mb-5 hover:text-[#800000] transition duration-200"
                href="{{ url()->previous() }}">
                <svg class="h-4 w-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                Back to results
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 divide-y divide-gray-100">
            <!-- Document title -->
            <div class="px-6 pt-4 pb-2">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $documentResults->title }}</h1>

                <!-- Publication date -->
                <p class="text-sm text-gray-500 mt-2">
                    Published: {{ \Carbon\Carbon::parse($documentResults->created_at)->format('F j, Y') }}
                </p>
            </div>

            <!-- Main content -->
            <d class="px-6 py-4">
                <!-- Author card -->
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Author/s
            </d>
            <div class="flex items-center mb-6 p-4 bg-gray-50 rounded-lg">
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $documentResults->authors }}</h3>
                </div>
            </div>

            <!-- Abstract section -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Abstract</h2>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-700 leading-relaxed">{{ $documentResults->abstract }}</p>
                </div>
            </div>

            <!-- Keywords/Topics -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Field/Topic</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $documentResults->keyword) as $keyword)
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">{{ trim($keyword) }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>