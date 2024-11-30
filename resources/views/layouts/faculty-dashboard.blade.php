@section('content')
<table class="min-w-full bg-white border border-gray-200">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">ID</th>
            <th class="py-2 px-4 border-b">Title</th>
            <th class="py-2 px-4 border-b">Abstract</th>
            <th class="py-2 px-4 border-b">Field</th>
            <th class="py-2 px-4 border-b">Status</th>
            <th class="py-2 px-4 border-b">First Name</th>
            <th class="py-2 px-4 border-b">Last Name</th>
            <th class="py-2 px-4 border-b">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($documents as $item)
        <tr>
            <td class="py-2 px-4 border-b text-center">{{ $item->id }}</td>
            <td class="py-2 px-4 border-b text-center">{{ $item->title }}</td>
            <td class="py-2 px-4 border-b text-center">{{ $item->abstract }}</td>
            <td class="py-2 px-4 border-b text-center">{{ $item->field_topic }}</td>
            <td class="py-2 px-4 border-b text-center">{{ $item->name }}</td>
            <td class="py-2 px-4 border-b text-center">{{ $item->first_name }}</td>
            <td class="py-2 px-4 border-b text-center">{{ $item->last_name }}</td>
            <td class="py-2 px-4 border-b text-center">
                <div>
                    <a href="{{ route('download-document', ['id' => $item->id]) }}" class="bg-blue-500 text-white py-1 px-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">Download</a>
                    <a href="{{ route('approve-documents', ['id' => $item->id]) }}" class="bg-green-500 text-white py-1 px-3 rounded focus:outline-none focus:ring-2 focus:ring-green-300">Approve</a>
                    <a href="{{ route('reject-documents', ['id' => $item->id]) }}" class="bg-red-500 text-white py-1 px-3 rounded focus:outline-none focus:ring-2 focus:ring-red-300">Reject</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
<!-- documents.id, documents.title, documents.abstract, documents.field_topic, document_statuses.name, 
student.first_name, student.last_name -->