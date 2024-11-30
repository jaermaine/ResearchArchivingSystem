@section('title', 'Dashboard')

@section('content')

    <!-- Student/Faculty layout content -->
    @if(Auth::user()->role == 'student')
        @extends('layouts.student-dashboard')
    @elseif(Auth::user()->role == 'faculty')
        @extends('layouts.faculty-dashboard')
    @endif
@endsection