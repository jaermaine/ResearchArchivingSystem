<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adviser;

class AdviserListController extends Controller
{
    public function fetchAdviser()
    {
        $faculties = Adviser::all();
        return view('layouts.student-dashboard', compact('adviser'));
    }
}
