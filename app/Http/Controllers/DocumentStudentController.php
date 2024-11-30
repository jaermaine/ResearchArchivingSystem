<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DocumentStudentController extends Controller
{
    public function setTable()
    {
        $faculty_id = DB::table('faculty')
            ->where('user_id', '=', Auth::user()->id)
            ->value('id');

        $documents = DB::table('document_student')
            ->join('documents', 'document_student.document_id', '=', 'documents.id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->join('document_statuses', 'documents.document_status_id', '=', 'document_statuses.id')
            ->join('document_faculty', 'documents.id', '=', 'document_faculty.document_id')
            ->join('faculty', 'document_faculty.faculty_id', '=', 'faculty.id')
            ->select('documents.id', 'documents.title', 'documents.abstract', 'documents.field_topic', 
            'document_statuses.name', 'student.first_name', 'student.last_name')
            ->where('faculty_id', '=', $faculty_id)
            ->get();

        return view('dashboard', data: ['documents' => $documents]);
    }
}
