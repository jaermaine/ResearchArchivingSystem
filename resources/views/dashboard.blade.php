@section('title', 'Dashboard')

@section('content')

    <!-- Student/Faculty layout content -->
    @if(Auth::user()->role == 'student')
        @include('layouts.student-dashboard')
    @elseif(Auth::user()->role == 'faculty')
        @include('layouts.faculty-dashboard')
    @endif
@endsection