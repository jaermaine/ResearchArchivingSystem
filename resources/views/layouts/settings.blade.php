<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
</head>

<body>
  <div>
    @extends('layouts.app')
    @section('content')

    <div class="container">

      <!-- Display Name -->
      <div class="user-info flex items-center">
        <label class="block font-medium text-xl text-gray-700 dark:text-gray-300 text-red-600 mr-2" for="current_name" style="color: #b30000;">
          Current Name:
        </label>
        <h2 class="text-black text-xl" id="current_name">{{ $firstName ?? 'Not set' }} {{ $lastName ?? 'Not set' }}</h2>
      </div>

      <!-- Settings Form -->
      <form action="{{ route('settings.updateSettings') }}" method="POST">
        @csrf
        <div class="space-y-2">

          <!-- Change Name -->
          <label class="block font-medium text-xl text-gray-700 dark:text-gray-300 text-red-600" for="change_name" style="color: #b30000;">
            Change Name
          </label>
          <div>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required
              class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
              style="color: black; border: 2px solid #b30000; background-color: #ffffff;" placeholder="First Name">
          </div>
          <div>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required
              class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
              style="color: black; border: 2px solid #b30000; background-color: #ffffff;" placeholder="Last Name">
          </div>

          <!-- Contact Number -->
          <label class="block font-medium text-xl text-gray-700 dark:text-gray-300 text-red-600" for="contact_number" style="color: #b30000;">
            Contact Number
          </label>
          <div>
            <input type="text" name="contact_number" id="contact_number"
              class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
              style="color: black; border: 2px solid #b30000; background-color: #ffffff;" placeholder="Enter your contact number"
              value="{{ auth()->user()->contact_number }}">
          </div>

          <!-- Change Password -->
          <label class="block font-medium text-xl text-gray-700 dark:text-gray-300 text-red-600" for="change_password" style="color: #b30000;">
            Change Password
          </label>
          <div>
            <input type="password" name="current_password" id="current_password"
              class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
              style="color: black; border: 2px solid #b30000; background-color: #ffffff;" placeholder="Current Password">
          </div>
          <div>
            <input type="password" name="new_password" id="new_password"
              class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
              style="color: black; border: 2px solid #b30000; background-color: #ffffff;" placeholder="New Password">
          </div>
          <div>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
              class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
              style="color: black; border: 2px solid #b30000; background-color: #ffffff;" placeholder="Confirm New Password">
          </div>

          <!-- Save Changes Button -->
          <button type="submit" class="h-10 px-6 py-2 bg-[#800000] text-white text-sm font-medium font-['Inter'] rounded-md justify-center items-center gap-2.5 inline-flex">
            Save Changes
          </button>
        </div>
      </form>

      <!-- Messages -->
      @if ($errors->any())
      <div class="text-red-500">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      @if (session('success'))
      <div class="text-green-500 font-bold">
        {{ session('success') }}
      </div>
      @endif

    </div>
    @endsection
</body>

</html>