@extends('layouts.app')
@title('Edit Academic Information')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')

<form action=" {{ route('update_academic') }}" method="POST">
    @csrf
    <div class="md:w-1/2 md:pl-6">
        <a class="underline inline-flex items-center text-xs text-gray-600 hover:text-red-300" href="/settings"> <!-- Smaller text -->
            <svg class="h-3 w-3 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <!-- Smaller icon -->
                <polyline points="15 18 9 12 15 6" />
            </svg>
            Back
        </a>
        <h2 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4 text-[#800000]">Academic Information</h2>

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
            <label
                class="block font-medium text-base sm:text-xl text-gray-700 dark:text-gray-300 text-red-600">College</label>
            <select name="college_id" x-model="selectedCollegeId" @change="updatePrograms()" class="w-full border p-2 rounded">
                <option value="" disabled selected>Select a College</option>
                @foreach($colleges as $college)
                <option value="{{ $college->id }}">{{ $college->name }}</option>
                @endforeach
            </select>

            <!-- Program Dropdown (Filtered based on College) -->
            <label
                class="block font-medium text-base sm:text-xl text-gray-700 dark:text-gray-300 text-red-600 mt-4">Program</label>
            <select name="program_id" class="w-full border p-2 rounded">
                <option value="" disabled selected>Select a Program</option>
                <template x-for="program in filteredPrograms" :key="program . id">
                    <option :value="program . id" x-text="program.name"></option>
                </template>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit"
                class="h-8 sm:h-10 px-4 sm:px-6 py-1 sm:py-2 bg-[#800000] hover:bg-red-700 text-white text-xs sm:text-sm font-medium font-['Inter'] rounded-md justify-center items-center gap-2 sm:gap-2.5 inline-flex">
                Save Changes
            </button>
        </div>
</form>
</div>
@endsection