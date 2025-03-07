<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id); // Get the authenticated user

        // Check the user's role and return the appropriate view
        if ($user -> hasRole ('adviser')) {
            return view('adviser-dashboard'); // Admin-specific dashboard
        } elseif ($user -> hasRole('student')) {
            return view('student-dashboard'); // Student-specific dashboard
        } elseif ($user -> hasRole('admin')) {
            return view('admin-dashboard'); // Admin-specific dashboard
        }

        // Default view for unrecognized roles or fallback
        return view('dashboard');
    }
}
