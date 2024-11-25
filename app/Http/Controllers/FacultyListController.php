<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;

class FacultyListController extends Controller
{
    public function fetchFaculties()
    {
        $faculties = Faculty::all();
        return view('layouts.student-dashboard', compact('faculties'));
    }
}
