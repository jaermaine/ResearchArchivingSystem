@section('content')
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Abstract</th>
                <th>Field</th>
                <th>Status</th>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->abstract }}</td>
                <td>{{ $item->field_topic }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->first_name }}</td>
                <td>{{ $item->last_name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

<!-- documents.id, documents.title, documents.abstract, documents.field_topic, document_statuses.name, 
student.first_name, student.last_name -->