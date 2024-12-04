<div class="w-full md:w-[1250px] h-auto relative mb-4 p-4 bg-white rounded-md shadow">
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