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
    </div>

    <div x-show="activeTab === 'users'"
        x-data="{ userType: 'students', openEditModal: false, selectedStudent: {}, selectedAdviser: {} }"
        class="p-4 border rounded-md shadow-md bg-white">

        <!-- Toggle Buttons -->
        <div class="flex space-x-4 mb-4">
            <button @click="userType = 'students'" :class="userType === 'students' ? 'bg-red-600' : 'bg-gray-800'"
                class="px-4 py-2 text-white rounded-md hover:bg-gray-700">
                Students
            </button>
            <button @click="userType = 'advisers'" :class="userType === 'advisers' ? 'bg-red-600' : 'bg-gray-800'"
                class="px-4 py-2 text-white rounded-md hover:bg-gray-700">
                Advisers
            </button>
        </div>

        <!-- Students Section -->
        <div x-show="userType === 'students'">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                @foreach($students as $student)
                <div class="bg-white rounded shadow-lg p-4 relative mb-4">
                    <p><strong>ID:</strong> {{ $student->id }}</p>
                    <p><strong>Name:</strong> {{ $student->last_name }}, {{ $student->first_name }}</p>
                    <p><strong>Email:</strong> {{ $student->email }}</p>
                    <p><strong>College:</strong> {{ $student->college }}</p>
                    <p><strong>Program:</strong> {{ $student->program }}</p>

                    <!-- Edit Button -->
                    <button @click="openEditModal = true; selectedStudent = {{ json_encode($student) }}"
                        class="bg-gray-800 text-white px-4 py-2 mt-3 rounded-md w-full">
                        Edit
                    </button>
                </div>
                @endforeach
            </div>

            <!-- Modal for Editing -->
            <div x-show="openEditModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50"
                x-data="{
                        filteredPrograms: [],
                        updatePrograms() {
                            let selectedCollegeId = this.selectedStudent.college_id;
                            if (!selectedCollegeId) return;

                            fetch('{{ route('filter-programs') }}?college_id=' + selectedCollegeId)
                                .then(response => response.json())
                                .then(data => {
                                    this.filteredPrograms = data;
                                });
                        }
                    }" x-init="updatePrograms()">

                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Edit Student</h2>
                    <form method="POST" action="{{ route('update-student') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="student_id" x-model="selectedStudent.id">

                        <label class="block">First Name</label>
                        <input type="text" name="first_name" class="w-full border p-2 rounded"
                            x-model="selectedStudent.first_name">

                        <label class="block mt-2">Last Name</label>
                        <input type="text" name="last_name" class="w-full border p-2 rounded"
                            x-model="selectedStudent.last_name">

                        <label class="block mt-2">Email</label>
                        <input type="text" name="email" class="w-full border p-2 rounded"
                            x-model="selectedStudent.email">

                        <label class="block mt-2">Section</label>
                        <input type="text" name="section" class="w-full border p-2 rounded"
                            x-model="selectedStudent.section">

                        <label class="block mt-2">Year Level</label>
                        <input type="text" name="year_level" class="w-full border p-2 rounded"
                            x-model="selectedStudent.year_level">

                        <label class="block mt-2">College</label>
                        <select name="college_id" class="w-full border p-2 rounded" x-model="selectedStudent.college_id"
                            @change="updatePrograms()">
                            <option value="" disabled selected>Select a College</option>
                            @foreach($college as $colleges)
                            <option value="{{ $colleges->id }}">{{ $colleges->name }}</option>
                            @endforeach
                        </select>

                        <label class="block mt-2">Program</label>
                        <select name="program_id" class="w-full border p-2 rounded"
                            x-model="selectedStudent.program_id">
                            <option value="" disabled selected>Select a Program</option>
                            <template x-for="program in filteredPrograms" :key="program . id">
                                <option :value="program . id" x-text="program.name"></option>
                            </template>
                        </select>

                        <div class="flex justify-end mt-4">
                            <button type="button" @click="openEditModal = false"
                                class="bg-gray-500 text-white px-4 py-2 rounded mr-2">
                                Cancel
                            </button>
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Advisers Section -->
        <div x-show="userType === 'advisers'">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($advisers as $adviser)
                <div class="bg-white rounded shadow-lg p-4 relative mb-4">
                    <p><strong>ID:</strong> {{ $adviser->id }}</p>
                    <p><strong>Name:</strong> {{ $adviser->last_name }}, {{ $adviser->first_name }}</p>
                    <p><strong>Email:</strong> {{ $adviser->email }}</p>
                    <p><strong>College:</strong> {{ $adviser->college }}</p>

                    <button @click="openEditModal = true; selectedAdviser = {{ json_encode($adviser) }}"
                        class="bg-gray-800 text-white px-4 py-2 mt-3 rounded-md w-full">
                        Edit
                    </button>
                </div>
                @endforeach
            </div>
            <div x-show="openEditModal"
                class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Edit Adviser</h2>
                    <form method="POST" action="{{ route('update-adviser') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="adviser_id" x-model="selectedAdviser.id">

                        <label class="block">First Name</label>
                        <input type="text" name="first_name" class="w-full border p-2 rounded"
                            x-model="selectedAdviser.first_name">

                        <label class="block mt-2">Last Name</label>
                        <input type="text" name="last_name" class="w-full border p-2 rounded"
                            x-model="selectedAdviser.last_name">

                        <label class="block mt-2">Email</label>
                        <input type="text" name="email" class="w-full border p-2 rounded"
                            x-model="selectedAdviser.email">

                        <label class="block mt-2">College</label>
                        <select name="college_id" class="w-full border p-2 rounded"
                            x-model="selectedAdviser.college_id">
                            <option value="" disabled selected>Select a College</option>
                            @foreach($college as $colleges)
                            <option value="{{ $colleges->id }}">{{ $colleges->name }}</option>
                            @endforeach
                        </select>

                        <div class="flex justify-end mt-4">
                            <button type="button" @click="openEditModal = false"
                                class="bg-gray-500 text-white px-4 py-2 rounded mr-2">
                                Cancel
                            </button>
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div x-show="activeTab === 'programs'" x-data="{ selectedCollege: null }" class="p-4 border rounded-md shadow-md bg-white">

        <!-- College Filter Buttons -->
        <div class="flex flex-wrap gap-2 mb-4">
            <button @click="selectedCollege = null"
                :class="selectedCollege === null ? 'bg-red-600' : 'bg-gray-800'"
                class="px-4 py-2 text-white rounded-md hover:bg-gray-700">
                Show All
            </button>
            @foreach ($college as $colleges)
            <button @click="selectedCollege = {{ $colleges->id }}"
                :class="selectedCollege === {{ $colleges->id }} ? 'bg-red-600' : 'bg-gray-800'"
                class="px-4 py-2 text-white rounded-md hover:bg-gray-700">
                {{ $colleges->name }}
            </button>
            @endforeach
        </div>

        <!-- Unified Programs List -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($college as $colleges)
            @foreach ($colleges->program as $programs)
            <div x-show="selectedCollege === null || selectedCollege === {{ $colleges->id }}" class="bg-white rounded shadow-lg p-4">
                <p><strong>Name:</strong> {{ $programs->name }}</p>
                <p><strong>Abbreviation:</strong> {{ $programs->abbreviation }}</p>
            </div>
            @endforeach
            @endforeach
        </div>
    </div>

    <div x-show="activeTab === 'colleges'" class="p-4 border rounded-md shadow-md bg-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($college as $colleges)
            <div class="bg-white rounded shadow-lg p-4 relative mb-4">
                <p><strong>Name:</strong> {{ $colleges->name }}</p>
            </div>
            @endforeach
        </div>

    </div>

    <!-- Add Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    @endsection