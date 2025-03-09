<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DocumentStudentController extends Controller
{
    public function setTable()
    {
        $role = Auth::user()->role;
        
        if($role == 'student') {
            $documents = $this->setTableForStudent();
        }
        else if ($role == 'adviser'){
            $documents = $this->setTableForAdviser();
        } else {
        if ($role == 'admin')
            $documents = $this->setTableForAdmin();
        }

        return view('dashboard', data: ['documents' => $documents]);
    }

    public function setTableForAdviser(){
        $adviser_id = DB::table('adviser')
            ->where('user_id', '=', Auth::user()->id)
            ->value('id');

        $documents = DB::table('document_student')
            ->join('documents', 'document_student.document_id', '=', 'documents.id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->join('document_statuses', 'documents.document_status_id', '=', 'document_statuses.id')
            ->join('document_adviser', 'documents.id', '=', 'document_adviser.document_id')
            ->join('adviser', 'document_adviser.adviser_id', '=', 'adviser.id')
            ->select('documents.id', 'documents.title', 'documents.abstract', 'documents.keyword', 
            'document_statuses.name', 'student.first_name', 'student.last_name', 'documents.document_status_id')
            ->where('adviser_id', '=', $adviser_id)
            ->get();

        return $documents;
    }

    public function setTableForStudent(){
        $student_id = DB::table('student')
            ->where('user_id', '=', Auth::user()->id)
            ->value('id');

        $documents = DB::table('document_student')
            ->join('documents', 'document_student.document_id', '=', 'documents.id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->join('document_statuses', 'documents.document_status_id', '=', 'document_statuses.id')
            ->join('document_adviser', 'documents.id', '=', 'document_adviser.document_id')
            ->join('adviser', 'document_adviser.adviser_id', '=', 'adviser.id')
            ->select('documents.id', 'documents.title', 'documents.abstract', 'documents.keyword', 
            'document_statuses.name', 'adviser.first_name', 'adviser.last_name')
            ->where('student_id', '=', $student_id)
            ->get();

        return $documents;
    }
    public function setTableForAdmin(){
        $documents = DB::table('documents')
            ->join('document_student', 'documents.id', '=', 'document_student.document_id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->join('document_statuses', 'documents.document_status_id', '=', 'document_statuses.id')
            ->join('document_adviser', 'documents.id', '=', 'document_adviser.document_id')
            ->join('adviser', 'document_adviser.adviser_id', '=', 'adviser.id')
            ->select('documents.id', 'documents.title', 'student.first_name as student_first_name', 
            'student.last_name as student_last_name', 'adviser.first_name as adviser_first_name', 
            'adviser.last_name as adviser_last_name', 'document_statuses.name as status', 'documents.document_status_id') 
            ->get();

        return $documents;
    }
}
