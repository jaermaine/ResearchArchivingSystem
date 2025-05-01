@section('content')
<div class="bg-gray-50 p-6 rounded-xl">
    <!-- Dashboard Header -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Research Documents</h2>
    </div>

    <!-- Documents Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($documents as $item)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200 overflow-hidden">
            <!-- Card Header with Status -->
            <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                <span class="text-sm text-gray-500">#{{ $item->id }}</span>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                    @if($item->document_status_id == 1) bg-yellow-100 text-yellow-800
                    @elseif($item->document_status_id == 2) bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                    @if($item->document_status_id == 1)
                        <svg class="mr-1 h-2 w-2 text-yellow-500" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        Pending Review
                    @elseif($item->document_status_id == 2)
                        <svg class="mr-1 h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        Approved
                    @else
                        <svg class="mr-1 h-2 w-2 text-red-500" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        Rejected
                    @endif
                </span>
            </div>
            
            <!-- Document Title -->
            <div class="px-5 py-3 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800 text-lg truncate" title="{{ $item->title }}">
                    {{ \Illuminate\Support\Str::limit($item->title, 60) }}
                </h3>
                <div class="flex items-center mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="ml-2 text-sm text-gray-600">{{ $item->first_name }} {{ $item->last_name }}</span>
                </div>
            </div>
            
            <!-- Abstract Preview -->
            <div class="px-5 py-4">
                <div class="mb-3">
                    <h4 class="text-xs uppercase tracking-wide text-gray-500 font-semibold mb-1">Abstract</h4>
                    <p class="text-sm text-gray-600 line-clamp-3">{{ $item->abstract }}</p>
                </div>
                
                <!-- Keywords -->
                <div>
                    <h4 class="text-xs uppercase tracking-wide text-gray-500 font-semibold mb-1">Keywords</h4>
                    <p class="text-sm text-gray-600">{{ $item->keyword }}</p>
                </div>
            </div>
            
            <!-- Card Actions -->
            <div class="px-5 py-4 bg-gray-50 border-t border-gray-100">
                <div class="flex flex-wrap gap-2">
                    @if($item->document_status_id == 1)
                        <a href="{{ route('download-document', ['id' => $item->id]) }}" 
                           class="flex items-center justify-center px-3 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download
                        </a>
                        <a href="{{ route('approve-documents', ['id' => $item->id]) }}" 
                           class="flex items-center justify-center px-3 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Approve
                        </a>
                        <a href="{{ route('reject-documents', ['id' => $item->id]) }}" 
                           class="flex items-center justify-center px-3 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reject
                        </a>
                    @endif

                    @if($item->document_status_id == 2 || $item->document_status_id == 3)
                        <a href="{{ route('download-document', ['id' => $item->id]) }}" 
                           class="flex items-center justify-center px-3 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download
                        </a>
                        <a href="{{ route('edit-documents', ['id' => $item->id]) }}" 
                           class="flex items-center justify-center px-3 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State Message -->
    @if(count($documents) == 0)
    <div class="bg-white rounded-xl shadow-sm p-12 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">No documents found</h3>
        <p class="mt-1 text-sm text-gray-500">There are no documents available for review at this time.</p>
    </div>
    @endif
    
    <!-- Enhanced Pagination -->
    @if(count($documents) > 0)
    <div class="mt-6 px-6 py-4 bg-white rounded-xl shadow-sm border border-gray-100">
        {{ $documents->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection