<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Faculty;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        // Check if the user is a student or faculty
        $student = Student::where('user_id', $userId)->first();
        $faculty = Faculty::where('user_id', $userId)->first();

        // Set first name and last name based on user type
        if ($student) {
            $firstName = $student->first_name;
            $lastName = $student->last_name;
        } elseif ($faculty) {
            $firstName = $faculty->first_name;
            $lastName = $faculty->last_name;
        } else {
            return redirect()->route('home')->with('error', 'User role not found.');
        }

        return view('layouts.settings', compact('firstName', 'lastName'));
    }

    public function updateName(Request $request)
    {
        // Validate name fields
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
        ]);

        $user = Auth::user();
        $userId = $user->id;

        // Initialize firstName and lastName from the request
        $firstName = $request->first_name;
        $lastName = $request->last_name;

        // Use Eloquent models instead of DB facade
        $student = Student::where('user_id', $userId)->first();
        $faculty = Faculty::where('user_id', $userId)->first();

        if ($student) {
            $student->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
            ]);
        } elseif ($faculty) {
            $faculty->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
            ]);
        } else {
            return redirect()->route('home')->with('error', 'User role not found.');
        }

        // Return with success message
        return back()->with('success', 'Name updated successfully!');
    }

    public function addContact(Request $request)
    {
        // Validate the contact number
        $request->validate([
            'contact_number' => 'required|regex:/^[0-9]{10,15}$/|unique:users,contact_number',
        ], [
            'contact_number.required' => 'Contact number is required.',
            'contact_number.regex' => 'Contact number must be 10-15 digits.',
            'contact_number.unique' => 'This contact number is already in use.',
        ]);

        // Update the contact number for the authenticated user
        $user = Auth::user();
        $user->contact_number = $request->contact_number;
        $user->save();

        // Redirect back with a success message
        return back()->with('success', 'Contact number added successfully!');
    }
}
