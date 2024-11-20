@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </div>

    <!-- Your dashboard content goes here -->

    <!-- Student/Faculty layout content -->
    @if(Auth::user()->role == 'student')
        @include('layouts.student-dashboard')
    @elseif(Auth::user()->role == 'faculty')
        @include('layouts.faculty-dashboard')
    @endif
@endsection