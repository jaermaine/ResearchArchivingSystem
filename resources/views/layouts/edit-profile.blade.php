@extends('layouts.app')
@section('content')
<div>
    <a class="underline inline-flex items-center text-xs text-gray-600 hover:text-red-300" href="/settings"> <!-- Smaller text -->
        <svg class="h-3 w-3 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <!-- Smaller icon -->
            <polyline points="15 18 9 12 15 6" />
        </svg>
        Back
    </a>
    <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <script>
            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector("label[for='profile_picture_input'] img").src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        </script>
        <div class="mb-4">
            <label class="block font-medium text-base sm:text-xl text-gray-700 dark:text-gray-300 text-red-600 mb-1 sm:mb-2" for="profile_picture" style="color: #b30000;">
                Profile Picture:
            </label>
            <div class="flex items-start gap-4">
                <!-- Clickable Image to Trigger File Upload -->
                <div class="flex flex-col">
                    <label for="profile_picture_input" class="cursor-pointer">
                        <img src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}"
                            alt="Profile Picture"
                            class="w-[100px] h-[100px] sm:w-[150px] sm:h-[150px] md:w-[200px] md:h-[200px] lg:w-[300px] lg:h-[300px] object-cover rounded-full border-2 border-gray-300 shadow-md">
                    </label>

                    <!-- Hidden File Input -->
                    <input type="file" id="profile_picture_input" name="profile_picture" accept="image/*"
                        class="hidden" onchange="previewImage(event)">
                </div>
            </div>
        </div>
        <!-- Display Name -->
        <div class="user-info flex items-center">
            <label class="block font-medium text-base sm:text-xl text-gray-700 dark:text-gray-300 text-red-600 mr-1 sm:mr-2" for="current_name" style="color: #b30000;">
                Current Name:
            </label>
            <h2 class="text-black text-sm sm:text-xl" id="current_name">{{ $firstName ?? 'Not set' }} {{ $lastName ?? 'Not set' }}</h2>
        </div>

        <!-- Change Name -->
        <label class="block font-medium text-base sm:text-xl text-gray-700 dark:text-gray-300 text-red-600" for="change_name" style="color: #b30000;">
            Change Name
        </label>
        <div>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                style="color: black; border: 2px solid #b30000; background-color: #ffffff;" placeholder="First Name">
        </div>
        <div>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                style="color: black; border: 2px solid #b30000; background-color: #ffffff;" placeholder="Last Name">
        </div>

        <div>
            <button type="submit" class="h-8 sm:h-10 px-3 sm:px-4 py-1 sm:py-2 bg-[#800000] hover:bg-red-700 text-white text-xs sm:text-sm font-medium rounded-md mt-2 sm:mt-3">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection