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

    <div class="">
      <!-- Header Section -->
      <div class="flex items-center space-x-4">
        <img src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}" alt="User profile image" class="w-12 h-12 rounded-full">
        <div>
          <h1 class="text-xl font-semibold">{{ "{$firstName} {$lastName}" }}</h1>
          <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
        </div>
      </div>

      <!-- Buttons -->
      <div class="mt-4 flex space-x-2">
        <a href="{{ route('edit_profile') }}" class="bg-blue-600 text-white px-4 py-2 rounded flex items-center">
          <i class="fas fa-edit mr-2"></i> Edit Profile
        </a>
        <a href=" {{ route('edit_password') }}" class="bg-gray-700 text-white px-4 py-2 rounded flex items-center">
          <i class="fas fa-key mr-2"></i> Change Password
        </a>
      </div>

      <!-- Information Sections -->
      <div class="mt-6 grid grid-cols-2 gap-4">
        <!-- Personal Information -->
        <div>
          <h2 class="text-lg font-semibold">Personal Information</h2>
          <p class="mt-2"><strong>Name:</strong> {{ "{$firstName} {$lastName}" }}</p>
          <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>

        <!-- Academic Information -->
        <div>
          <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold">Academic Information</h2>
            <a href="settings/edit-academic" class="text-blue-600 text-sm flex items-center">
              <i class="fas fa-edit mr-1"></i> Edit
            </a>
          </div>
          <p class="mt-2"><strong>College:</strong> {{ $college->name ?? 'Not set' }}</p>
          <p><strong>Program:</strong> {{ $program->name ?? 'Not set' }}</p>
          <p><strong>Degree Level:</strong> {{ Auth::user()->academicProfile->degree_level ?? 'Not set' }}</p>
        </div>
      </div>
    </div>

    @endsection
</body>

</html>