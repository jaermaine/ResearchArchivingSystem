<div class="w-full md:w-[1250px] h-auto relative mb-4 p-4 bg-white rounded-md shadow">
    <a class="underline inline-flex items-center text-sm text-gray-600 hover:text-red-300" href="{{ url()->previous() }}">
        <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6" />
        </svg>
        Back
    </a>
    <hr><br>
    <h1 class="text-2xl font-bold mb-4 text-center">{{ $documentResults->title }}</h1>
    <div class="p-4">
        <p class="text-gray-700 mb-4">
            <strong>Abstract:</strong> {{ $documentResults->abstract }}
        </p>
        <p class="text-gray-700 mb-4">
            <strong>Field/Topic:</strong> {{ $documentResults->field_topic }}
        </p>
        <p class="text-gray-700 mb-4">
            <strong>Author:</strong> {{ $documentResults->last_name }}, {{ $documentResults->first_name }}
        </p>
        <p class="text-gray-700">
            <strong>Date Published:</strong> {{ $documentResults->created_at }}
        </p>
    </div>
</div>