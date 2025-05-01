<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title>User Management</title>
</head>

<body>
  <div>
    @extends('layouts.app')
    @section('content')

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
      <!-- Header Section -->
      <div class="flex flex-col items-center space-y-4">
        <div class="w-24 h-24 rounded-full bg-[#800000] text-white flex items-center justify-center">
          @include('layouts/profile-picture')
        </div>
        <div class="text-center">
          <h1 class="text-2xl font-bold">{{ "{$first_name} {$last_name}" }}</h1>
          <p class="text-gray-500 text-sm">{{ $email }}</p>
        </div>
      </div>

      <!-- Buttons -->
      <div class="mt-6 flex justify-center space-x-4">
        <a href="{{ route('edit_profile') }}" class="bg-[#800000] hover:bg-red-700 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 flex items-center">
          <i class="fas fa-edit mr-2"></i> Edit Profile
        </a>
        <a href="{{ route('edit_password') }}" class="bg-[#800000] hover:bg-red-700 text-white px-6 py-3 rounded-lg shadow-md hover:bg-gray-800 transition duration-300 flex items-center">
          <i class="fas fa-key mr-2"></i> Change Password
        </a>
      </div>

      <!-- Information Sections -->
      <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold mb-4">Personal Information</h2>
          <p class="mb-2"><strong>Name:</strong> {{ "{$first_name} {$last_name}" }}</p>
          <p><strong>Email:</strong> {{ $email }}</p>
        </div>

        <!-- Academic Information -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-md">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Academic Information</h2>
            <a href="settings/edit-academic" class="hover:text-red-700 text-red-800 text-sm flex items-center">
              <i class="fas fa-edit mr-1"></i> Edit
            </a>
          </div>
          <p class="mb-2"><strong>College:</strong> {{ $college->name ?? 'Not set' }}</p>
          <p class="mb-2"><strong>Program:</strong> {{ $program->name ?? 'Not set' }}</p>
          <p><strong>Program/Year/Section:</strong>
            {{ ($program?->abbreviation ?? 'Not set') . '' . ($year?->number ?? '') . '' . ($section?->section_number ?? '') }}
          </p>
        </div>
      </div>
    </div>

    @endsection
</body>

</html>