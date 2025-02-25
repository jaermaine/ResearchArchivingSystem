@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($documents as $item)
    <div class="bg-white rounded-md shadow-lg p-4">
        <div class="font-bold">ID: {{ $item->id }}</div>
        <div class="font-semibold">Title: {{ $item->title }}</div>
        <div>Abstract: {{ $item->abstract }}</div>
        <div>Field: {{ $item->field_topic }}</div>
        <div>Name: {{ $item->name }}</div>
        <div>First Name: {{ $item->first_name }}</div>
        <div>Last Name: {{ $item->last_name }}</div>
        <div class="flex justify-center space-x-2 mt-2">
            @if($item->document_status_id == 1)
            <a href="{{ route('download-document', ['id' => $item->id]) }}" class="bg-blue-500 text-white py-1 px-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">Download</a>
            <a href="{{ route('approve-documents', ['id' => $item->id]) }}" class="bg-green-500 text-white py-1 px-3 rounded focus:outline-none focus:ring-2 focus:ring-green-300">Approve</a>
            <a href="{{ route('reject-documents', ['id' => $item->id]) }}" class="bg-red-500 text-white py-1 px-3 rounded focus:outline-none focus:ring-2 focus:ring-red-300">Reject</a>
            @endif

            @if($item->document_status_id == 2 || $item->document_status_id == 3) <!-- Assuming that the submitted paper by student is approve or rejectesd -->
            <a href="{{ route('edit-documents', ['id' => $item->id]) }}" class="bg-purple-500 text-white py-1 px-3 rounded focus:outline-none focus:ring-2 focus:ring-purple-300">Edit</a> <!-- New Edit Button -->
            @endif

        </div>
    </div>
    @endforeach
</div>
@endsection
