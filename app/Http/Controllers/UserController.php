<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function fetchStudents()
    {
        $students = Student::all();
        return view('layouts.admin-dashboard', compact('students'));
    }
}
