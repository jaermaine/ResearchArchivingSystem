@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @if(Auth::user()->role == 'student')
        @include('layouts.student-dashboard')
    @elseif(Auth::user()->role == 'faculty')
        @include('layouts.adviser-dashboard', ['documents' => $documents])
    @endif
@endsection