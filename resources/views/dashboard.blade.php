@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Your dashboard content goes here -->

</x-app-layout>
@endsection