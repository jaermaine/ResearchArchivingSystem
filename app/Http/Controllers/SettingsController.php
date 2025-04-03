<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\Adviser;
use App\Models\User;
use App\Models\College;
use App\Models\Program;
use App\Models\Year;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class SettingsController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $userId = $user->id;

        // Check if the user is a student or adviser
        $student = Student::where('user_id', $userId)->first();
        $adviser = Adviser::where('user_id', $userId)->first();

        // Set first name and last name based on user type
        if ($student) {
            $firstName = $student->first_name;
            $lastName = $student->last_name;
            $college = College::where('id', $student->college_id)->first();
            $program = Program::where('id', $student->program_id)->first();
            $year = Year::where('id', $student->year_id)->first();
        } elseif ($adviser) {
            $firstName = $adviser->first_name;
            $lastName = $adviser->last_name;
            $college = College::where('id', $adviser->college_id)->first();
            $program = Program::where('id', $adviser->program_id)->first();
        } else {
            return redirect()->route('home')->with('error', 'User role not found.');
        }

        //Fetch colleges and programs

        return view('layouts.settings', compact('firstName', 'lastName', 'user', 'college', 'program'));
    }

    public function updateProfilePicture(Request $request)
    {
        if ($request->hasFile('profile_picture')) {
            $request->validate([
                'profile_picture' => 'image|max:2048'
            ]);

            /** @var \App\Models\User $user **/
            $user = Auth::user();

            // Delete old profile picture if it exists
            if ($user->profile_picture && Storage::disk('public')->exists('profile_pictures/' . $user->profile_picture)) {
                Storage::disk('public')->delete('profile_pictures/' . $user->profile_picture);
            }

            // Store new image
            $file = $request->file('profile_picture');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Store the original image
            $file->storeAs('profile_pictures', $fileName, 'public');

            // Update database
            $user->profile_picture = $fileName;
            $user->save();

            return back()->with('success', 'Profile picture updated successfully!');
        }
    }

    public function getNameAttribute()
    {
        $id = Auth::user()->id;

        if (Auth::user()->role == 'student') {
            $user = Student::where('user_id', $id)->first();
        } elseif (Auth::user()->role == 'adviser') {
            $user = Adviser::where('user_id', $id)->first();
        }
        return $user;
    }

    public function edit_profile()
    {
        $user = Auth::user();
        $userId = $user->id;
        $student = Student::where('user_id', $userId)->first();
        $adviser = Adviser::where('user_id', $userId)->first();
        if ($student) {
            $firstName = $student->first_name;
            $lastName = $student->last_name;
        } elseif ($adviser) {
            $firstName = $adviser->first_name;
            $lastName = $adviser->last_name;
        } else {
            return redirect()->route('home')->with('error', 'User role not found.');
        }
        return view('layouts.edit-profile', compact('firstName', 'lastName', 'user'));
    }

    public function update_profile(Request $request)
    {
        Log::info($request->all());
        if ($request->hasFile('profile_picture')) {
            $this->updateProfilePicture($request);
        }
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
        ]);
        Log::info("Validation passed");
        $user = Auth::user();
        $userId = $user->id;
        Log::info("User ID: " . $userId);

        $student = Student::where('user_id', $userId)->first();
        $adviser = Adviser::where('user_id', $userId)->first();

        Log::info("Student: " . ($student ? 'Found' : 'Not Found'));
        Log::info("Adviser: " . ($adviser ? 'Found' : 'Not Found'));

        if($student){
            if($request->filled('first_name')){
                $student->update([
                    'first_name' => $request->first_name,
                ]);
                Log::info("Student first name updated to: " . $student->first_name);
            }
            if($request->filled('last_name')){
                $student->update([
                    'last_name' => $request->last_name,
                ]);
                Log::info("Student last name updated to: " . $student->last_name);
            }
        }

        if($adviser){
            if($request->filled('first_name')){
                $adviser->update([
                    'first_name' => $request->first_name,
                ]);
                Log::info("Adviser first name updated to: " . $adviser->first_name);
            }
            if($request->filled('last_name')){
                $adviser->update([
                    'last_name' => $request->last_name,
                ]);
                Log::info("Adviser last name updated to: " . $adviser->last_name);
            }
        }
        return redirect()->route('settings')->with('success', 'Profile updated successfully.');
    }

    public function edit_academic()
    {
        $colleges = College::all();
        $programs = Program::all();
        return view('layouts.edit-academic', compact('colleges', 'programs'));
    }

    public function update_academic(Request $request)
    {
        // $request->validate([
        //     'college_id' => 'required|exists:college,id',
        //     'program_id' => 'exists:program,id',
        //     //'year_id' => 'required|exists:years,id',
        // ]);

        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        $adviser = Adviser::where('user_id', $user->id)->first();

        if ($student) {
            $student->college_id = $request->college_id;
            $student->program_id = $request->program_id;
            //$student->year_id = $request->year_id;
            $student->update();
        } elseif ($adviser) {
            $adviser->college_id = $request->college_id;
            //$adviser->program_id = $request->program_id;
            $adviser->update();
        }

        return redirect()->route('settings')->with('success', 'Academic details updated successfully.');
    }

    public function edit_password(){
        return view('layouts.edit-password');
    }

    public function update_password(Request $request)
    {
        Log::info($request->all());
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => ['required', 'string', 'confirmed', Rules\Password::min(8)
                ->mixedCase()
                ->symbols()
                ->numbers()],
        ], [
            'new_password.regex' => 'The new password must contain at least one uppercase letter, one lowercase letter, and one special character.',
        ]);
        Log::info("Validation passed");

        $id = Auth::user()->id;
        Log::info("User ID: " . $id);
        $user = User::where('id', $id)->first();
        Log::info("User: " . ($user ? 'Found' : 'Not Found'));

        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Incorrect current password.']);
            }
            $user->password = Hash::make($request->new_password);
        }
        Log::info("Current Passsword and New Password Matched");

        if ($request->filled('new_password') && $request->filled('new_password_confirmation')) {
            if ($request->new_password !== $request->new_password_confirmation) {
                return back()->withErrors(['new_password' => 'New password and confirmation do not match.']);
            }
        }
        Log::info("New Password and New Password Confirmation Matched");

        $user->password = Hash::make($request->new_password);
        $user->update();
        Log::info("Password updated successfully");

        return redirect()->route('settings')->with('success', 'Password updated successfully.');
    }
}
