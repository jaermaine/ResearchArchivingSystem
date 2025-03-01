<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\Adviser;
use App\Models\User;

class SettingsController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $userId = $user->id;

        // Check if the user is a student or adviser
        $student = Student::where('user_id', $userId)->first();
        $faculty = Adviser::where('user_id', $userId)->first();

        // Set first name and last name based on user type
        if ($student) {
            $firstName = $student->first_name;
            $lastName = $student->last_name;
        } elseif ($adviser) {
            $firstName = $adviser->first_name;
            $lastName = $adviser->last_name;
        } else {
            return redirect()->route('home')->with('error', 'User role not found.');
        }

        return view('layouts.settings', compact('firstName', 'lastName', 'user'));
    }

    public function updateSettings(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $userId = $user->id;

        // Validate the request
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:15|unique:users,contact_number,' . $userId,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[!@#$%^&*(),.?":{}|<>]/',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // New validation for profile picture
        ], [
            'new_password.regex' => 'The new password must contain at least one uppercase letter, one lowercase letter, and one special character.',
        ]);

        // Update name
        if ($request->filled('first_name') && $request->filled('last_name')) {
            $student = Student::where('user_id', $userId)->first();
            $adviser = Adviser::where('user_id', $userId)->first();

            if ($student) {
                $student->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                ]);
            } elseif ($adviser) {
                $adviser->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                ]);
            }
        }

        // Update contact number
        if ($request->filled('contact_number')) {
            $user->contact_number = $request->contact_number;
        }

        // Update password
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Incorrect current password.']);
            }

            $user->password = Hash::make($request->new_password);
        }

        return back()->with('success', 'Updated successfully.');
    }
}
