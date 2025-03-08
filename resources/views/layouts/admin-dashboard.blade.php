@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($documents as $document)
            <div class="bg-white rounded-md shadow-lg p-4 relative">
                <h2 class="text-xl font-semibold text-gray-800">Documents</h2>
                <div class="font-bold">ID: {{ $document->id }}</div>
                <div class="font-semibold">Title: {{ $document->title }}</div>
                <div>Student Name: {{ $document->student_last_name }}, {{ $document->student_first_name }}</div>
                <div>Adviser Name: {{ $document->adviser_last_name }}, {{ $document->adviser_first_name }}</div>
                <div>Status: 
                    <span class="font-bold">
                        @if($document->document_status_id == 1)
                            Pending
                        @elseif($document->document_status_id == 2)
                            Approved
                        @elseif($document->document_status_id == 3)
                            Rejected
                        @endif
                    </span>
                </div>

                <!-- Hover Dropdown Button -->
                <div x-data="{ open: false }" class="relative">
                    <button @mouseenter="open = true" @mouseleave="open = false" class="bg-gray-800 text-white px-4 py-2 mt-3 rounded-md">
                        Change Status
                    </button>

                    <div @mouseenter="open = true" @mouseleave="open = false" x-show="open" class="absolute mt-1 bg-white border rounded-md shadow-lg z-50">
                        <form action="{{ route('admin-edit', $document->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" name="status" value="1" class="block px-4 py-2 hover:bg-gray-200 w-full text-left">Pending</button>
                            <button type="submit" name="status" value="2" class="block px-4 py-2 hover:bg-gray-200 w-full text-left">Approved</button>
                            <button type="submit" name="status" value="3" class="block px-4 py-2 hover:bg-gray-200 w-full text-left">Rejected</button>
                        </form>
                    </div>
                </div>
                <form action="{{ route('admin-delete', $document->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full hover:bg-red-700"
                            onclick="return confirm('Are you sure you want to delete this document?')">
                        Delete
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection