@extends('layouts.app')
@section('title','Change Password')
@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-6">
    <!-- Back button with improved design -->
    <a class="inline-flex items-center text-gray-600 hover:text-red-700 transition duration-200 mb-6" href="/settings">
        <svg class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6" />
        </svg>
        <span>Back to Settings</span>
    </a>
    
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Change Your Password</h1>
    
    <form action="{{ route('update_password') }}" method="POST">
        @csrf
        
        <!-- Password form container -->
        <div class="bg-gray-50 p-6 rounded-lg mb-8 shadow-sm">
            <!-- Password Fields -->
            <div class="space-y-4">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                    <input type="password" name="current_password" id="current_password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Enter your current password"
                        autocomplete="off">
                </div>

                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="new_password" id="new_password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Enter your new password">
                </div>
                
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Confirm your new password">
                </div>
            </div>
            
            <!-- Password guidelines (optional) -->
            <div class="mt-4 text-sm text-gray-500">
                <p>Password should be at least 8 characters long and include a mix of letters, numbers, and symbols.</p>
            </div>
        </div>

        <!-- Submit Button -->
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