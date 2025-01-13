<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        // Custom validation messages
        $messages = [
            'new_password.required' => 'The new password field is required.',
            'new_password.min' => 'The new password must be at least 8 characters.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
            'new_password.regex' => 'The new password must have at least 8 characters, contain at least one uppercase letter, one lowercase letter, and one special character (e.g., !, @, #, $, %, etc.).',
        ];

        // Validate the input with custom messages
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'min:8', // Ensure at least 8 characters
                'confirmed', // Ensure confirmation matches
                'regex:/[a-z]/', // Must contain at least one lowercase letter
                'regex:/[A-Z]/', // Must contain at least one uppercase letter
                'regex:/[!@#$%^&*(),.?":{}|<>]/', // Must contain at least one special character
            ],
        ], $messages);

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Return success message with session flashing
        return back()->with('success', 'Your password has been changed successfully.');
    }
}
