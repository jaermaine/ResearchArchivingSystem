@extends('layouts.app')

@section('content')

    <div x-data="{ activeTab: 'documents' }" class="w-full">

        <!-- Tab Buttons -->
        <div class="flex space-x-4 mb-6">
            <button @click="activeTab = 'documents'" :class="activeTab === 'documents' ? 'bg-red-600' : 'bg-gray-800'"
                class="px-4 py-2 text-white rounded-md hover:bg-gray-700">
                Documents
            </button>
            <button @click="activeTab = 'users'" :class="activeTab === 'users' ? 'bg-red-600' : 'bg-gray-800'"
                class="px-4 py-2 text-white rounded-md hover:bg-gray-700">
                Users
            </button>
            <button @click="activeTab = 'programs'" :class="activeTab === 'programs' ? 'bg-red-600' : 'bg-gray-800'"
                class="px-4 py-2 text-white rounded-md hover:bg-gray-700">
                Programs
            </button>
            <button @click="activeTab = 'colleges'" :class="activeTab === 'colleges' ? 'bg-red-600' : 'bg-gray-800'"
                class="px-4 py-2 text-white rounded-md hover:bg-gray-700">
                Colleges
            </button>
        </div>

        <!-- Tab Content -->
        <div x-show="activeTab === 'documents'" class="p-4 border rounded-md shadow-md bg-white">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($documents as $document)                
                    <div class="bg-white rounded shadow-lg p-4 relative mb-4">
                    <h2 class="text-xl font-bold mb-4">Documents</h2>
                        <h3 class="text-lg font-semibold text-gray-800">Title: {{ $document->title }}</h3>
                        <p>ID: {{ $document->id }}</p>
                        <p>Student: {{ $document->student_last_name }}, {{ $document->student_first_name }}</p>
                        <p>Adviser: {{ $document->adviser_last_name }}, {{ $document->adviser_first_name }}</p>
                        <p>Status:
                            <span class="font-bold">
                                @if($document->document_status_id == 1)
                                    Pending
                                @elseif($document->document_status_id == 2)
                                    Approved
                                @else
                                    Rejected
                                @endif
                            </span>
                        </p>

                        <div x-data="{ open: false }" class="relative">
                            <button @mouseenter="open = true" @mouseleave="open = false"
                                class="bg-gray-800 text-white px-4 py-2 mt-3 rounded-md w-full">
                                Change Status
                            </button>

                            <div @mouseenter="open = true" @mouseleave="open = false" x-show="open"
                                class="absolute mt-1 bg-white border rounded-md shadow-lg z-50 w-full">
                                <form action="{{ route('admin-edit', $document->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="status" value="1"
                                        class="block px-4 py-2 hover:bg-gray-200 w-full text-middle">Pending</button>
                                    <button type="submit" name="status" value="2"
                                        class="block px-4 py-2 hover:bg-gray-200 w-full text-middle">Approved</button>
                                    <button type="submit" name="status" value="3"
                                        class="block px-4 py-2 hover:bg-gray-200 w-full text-middle">Rejected</button>
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

            <div x-show="activeTab === 'users'" class="p-4 border rounded-md shadow-md bg-white">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    
                        <div class="bg-white rounded shadow-lg p-4 relative mb-4">
                            <h2 class="text-xl font-bold mb-4">Users</h2>
                            
                            <!-- Add Users Table or List Here -->
                        </div>
                   
                </div>
            </div>

            <div x-show="activeTab === 'programs'" class="p-4 border rounded-md shadow-md bg-white">
                <h2 class="text-xl font-bold mb-4">Programs</h2>
                <!-- Add Programs Table or List Here -->
            </div>

            <div x-show="activeTab === 'colleges'" class="p-4 border rounded-md shadow-md bg-white">
                <h2 class="text-xl font-bold mb-4">Colleges</h2>
                <!-- Add Colleges Table or List Here -->
            </div>

        </div>
    </div>

    <!-- Add Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

@endsection