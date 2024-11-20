
@extends('layouts.student-dashboard')

@section('title', 'Student Dashboard')

@section('content')
    <div>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </div>

    <!-- Student-specific dashboard content goes here -->
@endsection