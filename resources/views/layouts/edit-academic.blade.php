@extends('layouts.app')
@section('title','Edit Academic Information')
@section('content')

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <!-- Back button -->
    <div class="p-4 border-b border-gray-200">
        <a class="inline-flex items-center text-gray-600 hover:text-red-700 transition duration-200" href="/settings">
            <svg class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6" />
            </svg>
            <span class="text-sm">Back to Settings</span>
        </a>
    </div>

    <!-- Title -->
    <div class="p-6 border-b border-gray-200">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 text-center">Edit Academic Information</h1>
    </div>

    <div class="p-6">
        <form action="{{ route('update_academic') }}" method="POST" class="space-y-4">
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
                <div class="space-y-2">
                    <label for="college_id" class="block text-sm font-medium text-gray-700">College</label>
                    <p class="text-xs text-gray-500">Current: {{ $college->name ?? "Not Set" }}</p>
                    <div class="relative">
                        <select id="college_id" name="college_id" x-model="selectedCollegeId" @change="updatePrograms()"
                            class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition-colors text-sm">
                            <option value="" disabled selected>Select a College</option>
                            @foreach($colleges as $college)
                            <option value="{{ $college->id }}">{{ $college->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Program Dropdown -->
                <div class="space-y-2">
                    <label for="program_id" class="block text-sm font-medium text-gray-700">Program</label>
                    <p class="text-xs text-gray-500">Current: {{ $program->name ?? "Not Set" }}</p>
                    <div class="relative">
                        <select id="program_id" name="program_id"
                            class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition-colors text-sm">
                            <option value="" disabled selected>Select a Program</option>
                            <template x-for="program in filteredPrograms" :key="program.id">
                                <option :value="program.id" x-text="program.name"></option>
                            </template>
                        </select>
                    </div>
                </div>

                <!-- Year and Section Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Year Dropdown -->
                    <div class="space-y-2">
                        <label for="year_id" class="block text-sm font-medium text-gray-700">Year</label>
                        <p class="text-xs text-gray-500">Current: {{ $year->number ?? "Not Set" }}</p>
                        <select id="year_id" name="year_id"
                            class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition-colors text-sm">
                            <option value="" disabled selected>Select Year</option>
                            @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Section Dropdown -->
                    <div class="space-y-2">
                        <label for="section_id" class="block text-sm font-medium text-gray-700">Section</label>
                        <p class="text-xs text-gray-500">Current: {{ $section->section_number ?? "Not Set" }}</p>
                        <select id="section_id" name="section_id"
                            class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition-colors text-sm">
                            <option value="" disabled selected>Select Section</option>
                            @foreach($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->section_number }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-6">
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 bg-[#800000] hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow-md transition duration-300 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@endsection