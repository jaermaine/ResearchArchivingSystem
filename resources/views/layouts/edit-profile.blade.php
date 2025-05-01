@extends('layouts.app')
@section('title','Edit Profile')
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
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 text-center">Edit Profile</h1>
    </div>  

    <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm space-y-4 border border-gray-100">
        <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data" class="space-y-1">
            @csrf
            <!-- Profile Picture and Current Name Section -->
            <div class="flex flex-col lg:flex-row lg:items-start gap-6">
                <!-- Left Column - Profile Picture -->
                <div class="flex flex-col items-center lg:w-1/3">
                    <label class="block font-medium text-base text-gray-700 mb-3">Profile Picture</label>
                    <label for="profile_picture_input" class="cursor-pointer group relative">
                        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-[#800000] text-white flex items-center justify-center overflow-hidden">
                            @include('layouts/profile-picture')
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-white text-xs sm:text-sm font-medium">Change Photo</span>
                        </div>
                    </label>
                    <input type="file" id="profile_picture_input" name="profile_picture" accept="image/*"
                        class="hidden" onchange="previewImage(event)">
                    <p class="text-xs sm:text-sm text-gray-500 mt-2">Click on image to change</p>
                </div>

                <!-- Right Column - Current Name and Update Form -->
                <div class="lg:w-2/3 space-y-6">
                    <!-- Current Name Display -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500 mb-1">Current Name</p>
                        <h2 class="text-lg font-medium text-gray-800">
                            {{ $first_name ?? 'Not set' }} {{ $last_name ?? 'Not set' }}
                        </h2>
                    </div>

                    <!-- Name Change Section -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-800">Update Your Name</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition-colors text-sm"
                                    placeholder="First Name">
                            </div>
                            <div class="space-y-1">
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition-colors text-sm"
                                    placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 bg-[#800000] hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow-md transition duration-300 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection