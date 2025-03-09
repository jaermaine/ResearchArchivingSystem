<div class="container mx-auto px-2">
    <div class="w-full md:w-[1250px] mx-auto h-auto relative mb-4 p-3 sm:p-4 bg-white rounded-md shadow border border-[#ffcccc]">
        <a class="underline inline-flex items-center text-sm sm:text-base text-gray-600 hover:text-red-300" 
           href="{{ url()->previous() }}">
            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6" />
            </svg>
            Back
        </a>
        <hr class="my-2"><br>
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2 sm:mb-4 text-center">{{ $documentResults->title }}</h1>
        <div class="p-2 sm:p-4">
            <p class="text-gray-700 mb-3 sm:mb-4 text-base sm:text-lg md:text-xl lg:text-2xl">
                <strong>Abstract:</strong> {{ $documentResults->abstract }}
            </p>
            <p class="text-gray-700 mb-3 sm:mb-4 text-base sm:text-lg md:text-xl lg:text-2xl">
                <strong>Field/Topic:</strong> {{ $documentResults->keyword }}
            </p>
            <p class="text-gray-700 mb-3 sm:mb-4 text-base sm:text-lg md:text-xl lg:text-2xl">
                <strong>Author:</strong> {{ $documentResults->last_name }}, {{ $documentResults->first_name }}
            </p>
            <p class="text-gray-700 text-base sm:text-lg md:text-xl lg:text-2xl">
                <strong>Date Published:</strong> {{ $documentResults->created_at }}
            </p>
        </div>
    </div>
</div>