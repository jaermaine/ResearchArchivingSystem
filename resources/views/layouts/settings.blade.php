@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
  <!-- Profile Section -->
  <div class="p-6 border-b border-gray-200">
    <div class="flex flex-col items-center space-y-4">
      <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-[#800000] text-white flex items-center justify-center overflow-hidden shadow-md">
        @include('layouts/profile-picture', ['user' => $information])
      </div>
      <div class="text-center">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ "{$first_name} {$last_name}" }}</h1>
        <p class="text-sm text-gray-600">{{ $email }}</p>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-6 flex flex-col sm:flex-row justify-center gap-3">
      <a href="{{ route('edit_profile') }}"
        class="w-full bg-[#800000] hover:bg-red-700 text-white px-5 py-2 rounded-md shadow-sm transition duration-200 flex items-center justify-center group">
        <i class="fas fa-edit mr-2 group-hover:scale-110 transition-transform"></i>
        <span class="text-sm font-medium">Edit Profile</span>
      </a>
      <a href="{{ route('edit_password') }}"
        class="w-full bg-[#800000] hover:bg-red-700 text-white px-5 py-2 rounded-md shadow-sm transition duration-200 flex items-center justify-center group">
        <i class="fas fa-key mr-2 group-hover:scale-110 transition-transform"></i>
        <span class="text-sm font-medium">Change Password</span>
      </a>
    </div>
  </div>

  <!-- Information Sections -->
  <div class="p-6 space-y-6">
    <!-- Personal Information -->
    <div class="space-y-4">
      <h2 class="text-lg font-semibold text-gray-800 pb-2 border-b border-gray-200">Personal Information</h2>
      <div class="space-y-3">
        <div class="flex flex-col gap-1">
          <strong class="text-sm text-gray-600">Name</strong>
          <span class="text-sm text-gray-800">{{ "{$first_name} {$last_name}" }}</span>
        </div>
        <div class="flex flex-col gap-1">
          <strong class="text-sm text-gray-600">Email</strong>
          <span class="text-sm text-gray-800 break-all">{{ $email }}</span>
        </div>
      </div>
    </div>

    <!-- Academic Information -->
    <div class="space-y-4">
      <div class="flex justify-between items-center pb-2 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">Academic Information</h2>
        <a href="settings/edit-academic"
          class="text-red-800 hover:text-red-700 text-sm flex items-center transition-colors group">
          <i class="fas fa-edit mr-1 group-hover:scale-110 transition-transform"></i>
          <span class="font-medium">Edit</span>
        </a>
      </div>
      <div class="space-y-3">
        <div class="flex flex-col gap-1">
          <strong class="text-sm text-gray-600">College</strong>
          <span class="text-sm text-gray-800">{{ $college->name ?? 'Not set' }}</span>
        </div>
        <div class="flex flex-col gap-1">
          <strong class="text-sm text-gray-600">Program</strong>
          <span class="text-sm text-gray-800">{{ $program->name ?? 'Not set' }}</span>
        </div>
        <div class="flex flex-col gap-1">
          <strong class="text-sm text-gray-600">Section</strong>
          <span class="text-sm text-gray-800">
            {{ ($program?->abbreviation ?? 'Not set') . ' ' . ($year?->number ?? '') . ($section?->section_number ?? '') }}
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection