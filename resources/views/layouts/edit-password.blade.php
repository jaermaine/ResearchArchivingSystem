@extends('layouts.app')
@section('content')
<div>
    <div class="md:w-1/2 md:pl-6">
        <a class="underline inline-flex items-center text-xs text-gray-600 hover:text-red-300" href="/settings"> <!-- Smaller text -->
            <svg class="h-3 w-3 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <!-- Smaller icon -->
                <polyline points="15 18 9 12 15 6" />
            </svg>
            Back
        </a>
        <form action="{{ route('update_password') }}" method="POST">
            @csrf
            <div class="user-info flex items-center">
                <label class="block font-medium text-base sm:text-xl text-gray-700 dark:text-gray-300 text-red-600" for="change_password" style="color: #b30000;">
                    Change Password
                </label>
            </div>

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
            <button type="submit" class="h-8 sm:h-10 px-4 sm:px-6 py-1 sm:py-2 bg-[#800000] hover:bg-red-700 text-white text-xs sm:text-sm font-medium font-['Inter'] rounded-md justify-center items-center gap-2 sm:gap-2.5 inline-flex">
                Save Changes
            </button>
        </form>
    </div>
</div>
@endsection