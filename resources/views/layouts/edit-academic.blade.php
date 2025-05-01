@extends('layouts.app')
@section('title','Edit Academic Information')
@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
    <!-- Back button with improved design -->
    <a class="inline-flex items-center text-gray-600 hover:text-red-700 transition duration-200 mb-6" href="/settings">
        <svg class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6" />
        </svg>
        <span>Back to Settings</span>
    </a>

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Academic Information</h1>

    <form action="{{ route('update_academic') }}" method="POST">
        @csrf
        <div x-data="{
        selectedCollegeId: '',
        filteredPrograms: [],
        updatePrograms() {
          if (!this.selectedCollegeId) return;
          
          fetch('{{ route('filter-programs') }}?college_id=' + this.selectedCollegeId)
          .then(response => response.json())
          .then(data => {
            this.filteredPrograms = data;
            });
            }
            }" x-init="updatePrograms()">

            <!-- College Dropdown -->
            <div class="mb-5">
                <label for="college_id" class="block font-medium text-gray-700 mb-2">College</label>
                <label for="college_id" class="block text-sm font-medium text-gray-500 mb-1">Current: {{ $college->name ?? "Not Set" }}</label>
                <div class="relative">
                    <select
                        id="college_id"
                        name="college_id"
                        x-model="selectedCollegeId"
                        @change="updatePrograms()"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white shadow-sm transition-colors">
                        <option value="" disabled selected>Select a College</option>
                        @foreach($colleges as $college)
                        <option value="{{ $college->id }}">{{ $college->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Program Dropdown (Filtered based on College) -->
            <div class="mb-6">
                <label for="program_id" class="block font-medium text-gray-700 mb-2">Program</label>
                <label for="program_id" class="block text-sm font-medium text-gray-500 mb-1">Current: {{ $program->name ?? "Not Set" }}</label>
                <div class="relative">
                    <select
                        id="program_id"
                        name="program_id"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white shadow-sm transition-colors">
                        <option value="" disabled selected>Select a Program</option>
                        <template x-for="program in filteredPrograms" :key="program.id">
                            <option :value="program.id" x-text="program.name"></option>
                        </template>
                    </select>
                    
                </div>
            </div>

            <!-- Year Dropdown -->
            <div class="mb-6">
                <label for="year_id" class="block font-medium text-gray-700 mb-2">Year</label>
                <label for="year_id" class="block text-sm font-medium text-gray-500 mb-1">Current: {{ $year->number ?? "Not Set" }}</label>
                <div class="relative">
                    <select
                        id="year_id"
                        name="year_id"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white shadow-sm transition-colors">
                        <option value="" disabled selected>Select Year</option>
                        @foreach ($years as $year)
                        <option value="{{ $year->id }}">{{ $year->number }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>

            <!-- Section Dropdown -->
            <div class="mb-6">
                <label for="section_id" class="block font-medium text-gray-700 mb-2">Section</label>
                <label for="section_id" class="block text-sm font-medium text-gray-500 mb-1">Current: {{ $section->section_number ?? "Not Set" }}</label>
                <div class="relative">
                    <select
                        id="section_id"
                        name="section_id"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white shadow-sm transition-colors">
                        <option value="" disabled selected>Select Section/Block</option>
                        @foreach($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->section_number }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-8">
            <button type="submit" class="px-6 py-3 bg-[#800000] hover:bg-red-700 text-white font-medium rounded-lg shadow-md transition duration-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection