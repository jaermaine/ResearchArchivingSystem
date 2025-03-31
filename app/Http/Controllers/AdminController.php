<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class AdminController extends Controller
{
    public function fetchStudents()
    {
        $students = Student::all();
        return view('layouts.admin-dashboard', compact('students'));
    }
}
