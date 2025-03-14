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

      <div class="container mx-auto p-3 sm:p-6" style="max-height: 600px; overflow-y: auto;">
        <!-- Main Wrapper with border -->
        <div class="flex flex-col md:flex-row gap-3 sm:gap-6 rounded-lg p-3 sm:p-6">

        <!-- Left Column: User Settings -->
        <div class="md:w-1/2">
          <h2 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4 text-[#800000]">User Settings</h2>

          <!-- Profile Picture -->
          <div class="mb-4">
          <label
            class="block font-medium text-base sm:text-xl text-gray-700 dark:text-gray-300 text-red-600 mb-1 sm:mb-2"
            for="profile_picture" style="color: #b30000;">
            Profile Picture:
          </label>

          <div class="flex items-start gap-4">
            <!-- Clickable Image to Trigger File Upload -->
            <div class="flex flex-col">
            <label for="profile_picture_input" class="cursor-pointer">
              <img src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}"
              alt="Profile Picture" class="w-[100px] h-[100px] sm:w-[150px] sm:h-[150px] md:w-[200px] md:h-[200px] lg:w-[300px] lg:h-[300px] 
          object-cover rounded-full border-2 border-gray-300 shadow-md">
            </label>

            <form action="{{ route('settings.updateProfilePicture') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <!-- Hidden File Input -->
              <input type="file" id="profile_picture_input" name="profile_picture" accept="image/*" required
              class="hidden" onchange="previewImage(event)">

              <button type="submit"
              class="h-8 sm:h-10 px-3 sm:px-4 py-1 sm:py-2 bg-[#800000] hover:bg-red-700 text-white text-xs sm:text-sm font-medium rounded-md mt-2 sm:mt-3">
              Save Picture
              </button>
            </form>
            </div>
          </div>
          </div>


          <script>
          function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
              document.querySelector("label[for='profile_picture_input'] img").src = e.target.result;
            };
            reader.readAsDataURL(file);
            }
          }
          </script>

          <!-- Settings Form -->
          <form action="{{ route('settings.updateSettings') }}" method="POST">
          @csrf
          <div class="space-y-2">

            <!-- Display Name -->
            <div class="user-info flex items-center">
            <label
              class="block font-medium text-base sm:text-xl text-gray-700 dark:text-gray-300 text-red-600 mr-1 sm:mr-2"
              for="current_name" style="color: #b30000;">
              Current Name:
            </label>
            <h2 class="text-black text-sm sm:text-xl" id="current_name">{{ $firstName ?? 'Not set' }}
              {{ $lastName ?? 'Not set' }}
            </h2>
            </div>

            <!-- Change Name -->
            <label class="block font-medium text-base sm:text-xl text-gray-700 dark:text-gray-300 text-red-600"
            for="change_name" style="color: #b30000;">
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

            <!-- Contact Number -->
            <label class="block font-medium text-base sm:text-xl text-gray-700 dark:text-gray-300 text-red-600"
            for="contact_number" style="color: #b30000;">
            Contact Number
            </label>
            <div>
            <input type="text" name="contact_number" id="contact_number"
              class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
              style="color: black; border: 2px solid #b30000; background-color: #ffffff;"
              placeholder="Enter your contact number" value="{{ auth()->user()->contact_number }}">
            </div>

            <!-- Change Password -->
            <label class="block font-medium text-base sm:text-xl text-gray-700 dark:text-gray-300 text-red-600"
            for="change_password" style="color: #b30000;">
            Change Password
            </label>
            <div>
            <input type="password" name="current_password" id="current_password"
              class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
              style="color: black; border: 2px solid #b30000; background-color: #ffffff;"
              placeholder="Current Password">
            </div>
            <div>
            <input type="password" name="new_password" id="new_password"
              class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
              style="color: black; border: 2px solid #b30000; background-color: #ffffff;"
              placeholder="New Password">
            </div>
            <div>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
              class="w-full sm:w-96 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
              style="color: black; border: 2px solid #b30000; background-color: #ffffff;"
              placeholder="Confirm New Password">
            </div>

            <!-- Save Changes Button -->
            <button type="submit"
            class="h-8 sm:h-10 px-4 sm:px-6 py-1 sm:py-2 bg-[#800000] hover:bg-red-700 text-white text-xs sm:text-sm font-medium font-['Inter'] rounded-md justify-center items-center gap-2 sm:gap-2.5 inline-flex">
            Save Changes
            </button>
          </div>
          </form>
        </div>

        <!-- Right Column: College and Program Dropdowns -->
        <div class="md:w-1/2 md:pl-6">
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
          <select x-model="selectedCollegeId" @change="updatePrograms()" class="w-full border p-2 rounded">
            <option value="" disabled selected>Select a College</option>
            @foreach($college as $colleges)
        <option value="{{ $colleges->id }}">{{ $colleges->name }}</option>
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
          <button type="button"
            class="h-8 sm:h-10 px-4 sm:px-6 py-1 sm:py-2 bg-[#800000] hover:bg-red-700 text-white text-xs sm:text-sm font-medium font-['Inter'] rounded-md justify-center items-center gap-2 sm:gap-2.5 inline-flex">
            Update
          </button>
          </div>
        </div>
        </div>
      </div>

      </div>
    @endsection
</body>

</html>