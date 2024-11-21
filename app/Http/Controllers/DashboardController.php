<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Models\User; // Import the User model
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user

        // Check the user's role and return the appropriate view
        if ($user->hasRole('faculty')) {
            return view('faculty-dashboard'); // Admin-specific dashboard
        } elseif ($user->hasRole('student')) {
            return view('student-dashboard'); // Student-specific dashboard
        }

        // Default view for unrecognized roles or fallback
        return view('dashboard');
    }
}
