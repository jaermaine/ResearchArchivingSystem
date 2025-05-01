@extends('layouts.app')
@section('title','Edit Profile')
@section('styles')
@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg p-8">
    <!-- Back button with improved design -->
    <a class="inline-flex items-center text-gray-600 hover:text-red-700 transition duration-200 mb-6" href="/settings">
        <svg class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6" />
        </svg>
        <span>Back to Settings</span>
    </a>

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Your Profile</h1>

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

        <!-- Profile Picture Section -->
        <div class="mb-8">
            <label class="block font-medium text-lg text-gray-700 mb-3">
                Profile Picture
            </label>
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <!-- Clickable Image with better styling -->
                <div class="flex flex-col items-center">
                    <label for="profile_picture_input" class="cursor-pointer group relative">
                        <div class="w-24 h-24 rounded-full bg-[#800000] text-white flex items-center justify-center mb-2">
                            @include('layouts/profile-picture')
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-white text-sm font-medium">Change Photo</span>
                        </div>
                    </label>

                    <!-- Hidden File Input -->
                    <input type="file" id="profile_picture_input" name="profile_picture" accept="image/*"
                        class="hidden" onchange="previewImage(event)">
                    <p class="text-sm text-gray-500 mt-2">Click on image to change</p>
                </div>

                <div class="flex-1 w-full">
                    <!-- Current Name Display -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-4 shadow-sm">
                        <p class="text-sm text-gray-500 mb-1">Current Name</p>
                        <h2 class="text-lg font-medium" id="current_name">{{ $first_name ?? 'Not set' }} {{ $last_name ?? 'Not set' }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Name Change Section -->
        <div class="bg-gray-50 p-6 rounded-lg mb-8 shadow-sm">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Update Your Name</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="First Name">
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Last Name">
                </div>
            </div>
        </div>

        <!-- Submit Button - Preserving original blue-600 color -->
        <div class="flex justify-end">
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