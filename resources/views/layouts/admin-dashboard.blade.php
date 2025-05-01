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
        x-data="{ 
        userType: 'students', 
        openAddModal: false, 
        openEditModal: false, 
        selectedStudent: {}, 
        selectedAdviser: {},
        newUser: { first_name: '', last_name: '', email: '', section: '', year_level: '', college_id: '', program_id: '' }
    }"
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

        <!-- Add Button -->
        <button @click="openAddModal = true; newUser = { first_name: '', last_name: '', email: '', section: '', year_level: '', college_id: '', program_id: '' }"
            class="bg-green-600 text-white px-4 py-2 rounded-md mb-4">
            Add <span x-text="userType === 'students' ? 'Student' : 'Adviser'"></span>
        </button>

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

                    <!-- Delete Button -->
                    <form method="POST" action="{{ route('delete-student', $student->id) }}" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 mt-2 rounded-md w-full">
                            Remove
                        </button>
                    </form>
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

                    <!-- Delete Button -->
                    <form method="POST" action="{{ route('delete-adviser', $adviser->id) }}" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 mt-2 rounded-md w-full">
                            Remove
                        </button>
                    </form>
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
        <!-- Add User Modal -->
        <div x-show="openAddModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3"
                x-data="{
            filteredPrograms: [],
            updatePrograms() {
                if (!this.newUser.college_id) return;
                fetch('{{ route('filter-programs') }}?college_id=' + this.newUser.college_id)
                    .then(response => response.json())
                    .then(data => {
                        this.filteredPrograms = data;
                    });
            },
            get formAction() {
                return this.userType === 'students' ? '{{ route('add-student') }}' : '{{ route('add-adviser') }}';
            }
        }"
                x-init="updatePrograms()">
                <h2 class="text-xl font-semibold mb-4">
                    Add <span x-text="userType === 'students' ? 'Student' : 'Adviser'"></span>
                </h2>

                <form method="POST" x-bind:action="formAction" x-ref="addUserForm">
                    @csrf
                    <input type="hidden" name="user_type" x-model="userType">

                    <!-- First Name -->
                    <label class="block">First Name</label>
                    <input type="text" name="first_name" class="w-full border p-2 rounded" x-model="newUser.first_name" required>

                    <!-- Last Name -->
                    <label class="block mt-2">Last Name</label>
                    <input type="text" name="last_name" class="w-full border p-2 rounded" x-model="newUser.last_name" required>

                    <!-- Email -->
                    <label class="block mt-2">Email</label>
                    <input type="email" name="email" class="w-full border p-2 rounded" x-model="newUser.email" required>

                    <!-- Section & Year Level (Only for Students) -->
                    <template x-if="userType === 'students'">
                        <div>
                            <label class="block mt-2">Section</label>
                            <input type="text" name="section" class="w-full border p-2 rounded" x-model="newUser.section">

                            <label class="block mt-2">Year Level</label>
                            <input type="text" name="year_level" class="w-full border p-2 rounded" x-model="newUser.year_level">
                        </div>
                    </template>

                    <!-- College Selection -->
                    <label class="block mt-2">College</label>
                    <select name="college_id" class="w-full border p-2 rounded" x-model="newUser.college_id" @change="updatePrograms()">
                        <option value="" disabled selected>Select a College</option>
                        @foreach($college as $colleges)
                        <option value="{{ $colleges->id }}">{{ $colleges->name }}</option>
                        @endforeach
                    </select>

                    <!-- Program Selection (Only for Students) -->
                    <template x-show="userType === 'students'">
                        <div>
                            <label class="block mt-2">Program</label>
                            <select name="program_id" class="w-full border p-2 rounded" x-model="newUser.program_id">
                                <option value="" disabled selected>Select a Program</option>
                                <template x-for="program in filteredPrograms" :key="program.id">
                                    <option :value="program.id" x-text="program.name"></option>
                                </template>
                            </select>
                        </div>
                    </template>

                    <!-- Modal Buttons -->
                    <div class="flex justify-end mt-4">
                        <button type="button" @click="openAddModal = false" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">
                            Cancel
                        </button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                            Add <span x-text="userType === 'students' ? 'Student' : 'Adviser'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-show="activeTab === 'programs'"
        x-data="{ 
        selectedCollege: '', 
        showForm: false, 
        formType: '', 
        form: { id: '', name: '', abbreviation: '', college_id: '' },
        currentPage: 1,
        itemsPerPage: 6,
        get filteredPrograms() {
            let programs = [];
            @foreach ($college as $colleges)
                @foreach ($colleges->program as $program)
                    if(this.selectedCollege === '' || this.selectedCollege == {{ $colleges->id }}) {
                        programs.push({
                            id: {{ $program->id }},
                            name: '{{ $program->name }}',
                            abbreviation: '{{ $program->abbreviation }}',
                            college_id: {{ $colleges->id }},
                            college_name: '{{ $colleges->name }}'
                        });
                    }
                @endforeach
            @endforeach
            return programs;
        },
        get totalPages() {
            return Math.ceil(this.filteredPrograms.length / this.itemsPerPage);
        },
        get paginatedPrograms() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.filteredPrograms.slice(start, end);
        },
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        goToPage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
            }
        }
     }"
        class="p-4 border rounded-md shadow-md bg-white">

        <!-- College Selection -->
        <div class="mb-4">
            <select x-model="selectedCollege" @change="currentPage = 1" class="w-full p-2 border rounded-md">
                <option value="">Show All</option>
                @foreach ($college as $colleges)
                <option value="{{ $colleges->id }}">{{ $colleges->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Add Program Button -->
        <button @click="showForm = true; formType = 'add'; form = { id: '', name: '', abbreviation: '', college_id: '' }"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md transition duration-200">
            + Add Program
        </button>

        <!-- Programs List -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <template x-for="program in paginatedPrograms" :key="program.id">
                <div class="bg-white rounded-md shadow-md p-4 border">
                    <p class="text-lg font-semibold" x-text="program.name"></p>
                    <p class="text-gray-600">Abbreviation: <span class="font-medium" x-text="program.abbreviation"></span></p>
                    <p class="text-gray-500 text-sm">College: <span x-text="program.college_name"></span></p>

                    <div class="mt-3 flex gap-2">
                        <button @click="showForm = true; formType = 'edit'; form = { 
                            id: program.id, 
                            name: program.name, 
                            abbreviation: program.abbreviation, 
                            college_id: program.college_id 
                        }"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-1 rounded-md transition duration-200">
                            Edit
                        </button>
                        <form :action="'/admin/delete-program/' + program.id" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-1 rounded-md transition duration-200">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty state message when no programs match the filter -->
        <div x-show="filteredPrograms.length === 0" class="text-center py-8 text-gray-500">
            <p>No programs found. Please add a new program or change the college filter.</p>
        </div>

        <!-- Pagination Controls -->
        <div class="flex items-center justify-between mt-6" x-show="filteredPrograms.length > 0">
            <div class="text-sm text-gray-700">
                Showing <span x-text="((currentPage - 1) * itemsPerPage) + 1"></span>
                to <span x-text="Math.min(currentPage * itemsPerPage, filteredPrograms.length)"></span>
                of <span x-text="filteredPrograms.length"></span> programs
            </div>

            <div class="flex space-x-2">
                <!-- Previous Button -->
                <button @click="prevPage()"
                    :disabled="currentPage === 1"
                    :class="{'opacity-50 cursor-not-allowed': currentPage === 1}"
                    class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300 transition">
                    Previous
                </button>

                <!-- Page Numbers -->
                <div class="flex space-x-1">
                    <template x-for="page in totalPages" :key="page">
                        <button @click="goToPage(page)"
                            :class="{'bg-[#800000] text-white': currentPage === page, 'bg-gray-200 hover:bg-gray-300': currentPage !== page}"
                            class="px-3 py-1 rounded-md transition">
                            <span x-text="page"></span>
                        </button>
                    </template>
                </div>

                <!-- Next Button -->
                <button @click="nextPage()"
                    :disabled="currentPage === totalPages"
                    :class="{'opacity-50 cursor-not-allowed': currentPage === totalPages}"
                    class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300 transition">
                    Next
                </button>
            </div>
        </div>

        <!-- Program Form (Add/Edit) Modal -->
        <div x-show="showForm" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-md w-96">
                <h2 x-text="formType === 'add' ? 'Add Program' : 'Edit Program'" class="text-xl font-semibold mb-4"></h2>

                <form :action="formType === 'add' ? '{{ route('add-program') }}' : '{{ route('update-program') }}'" method="POST">
                    @csrf
                    <template x-if="formType === 'edit'">
                        <input type="hidden" name="id" x-model="form.id">
                    </template>

                    <label class="block mb-2">Program Name:</label>
                    <input type="text" name="name" x-model="form.name" required class="w-full p-2 border rounded-md mb-2">

                    <label class="block mb-2">Abbreviation:</label>
                    <input type="text" name="abbreviation" x-model="form.abbreviation" required class="w-full p-2 border rounded-md mb-2">

                    <label class="block mb-2">College:</label>
                    <select name="college_id" x-model="form.college_id" required class="w-full p-2 border rounded-md mb-4">
                        @foreach ($college as $colleges)
                        <option value="{{ $colleges->id }}">{{ $colleges->name }}</option>
                        @endforeach
                    </select>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="showForm = false"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-md transition duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition duration-200">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-show="activeTab === 'colleges'" x-data="{ openAddModal: false, openEditModal: false, selectedCollege: {} }" class="p-4 border rounded-md shadow-md bg-white">
        <!-- Add College Button -->
        <button @click="openAddModal = true" class="bg-green-600 text-white px-4 py-2 mb-4 rounded-md hover:bg-green-700">
            Add College
        </button>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($college as $colleges)
            <div class="bg-white rounded shadow-lg p-4 relative mb-4">
                <p><strong>Name:</strong> {{ $colleges->name }}</p>

                <!-- Edit Button -->
                <button @click="openEditModal = true; selectedCollege = {{ json_encode($colleges) }}"
                    class="bg-gray-800 text-white px-4 py-2 mt-3 rounded-md w-full">
                    Edit
                </button>

                <!-- Remove Button -->
                <form action="{{ route('delete-college', $colleges->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full hover:bg-red-700"
                        onclick="return confirm('Are you sure you want to delete this college?')">
                        Remove
                    </button>
                </form>
            </div>
            @endforeach
        </div>

        <!-- Add College Modal -->
        <div x-show="openAddModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-xl font-semibold mb-4">Add College</h2>
                <form action="{{ route('add-college') }}" method="POST">
                    @csrf
                    <label class="block">College Name</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" required>

                    <div class="flex justify-end mt-4">
                        <button type="button" @click="openAddModal = false" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">
                            Cancel
                        </button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                            Add College
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit College Modal -->
        <div x-show="openEditModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-xl font-semibold mb-4">Edit College</h2>
                <form action="{{ route('update-college') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="college_id" x-model="selectedCollege.id">

                    <label class="block">College Name</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" x-model="selectedCollege.name" required>

                    <div class="flex justify-end mt-4">
                        <button type="button" @click="openEditModal = false" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">
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

    <!-- Add Alpine.js -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('userForm', () => ({
                userType: 'students',
                submitForm() {
                    let form = this.$refs.addUserForm;
                    form.action = this.userType === 'students' ? "{{ route('add-student') }}" : "{{ route('add-adviser') }}";
                    form.submit();
                }
            }));
        });
    </script>
    @endsection