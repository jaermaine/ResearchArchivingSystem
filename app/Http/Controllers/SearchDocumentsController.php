<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchDocumentsController extends Controller
{
    public $search_input;

    public function search_document($search_input = '')
    {
        $searchResults = DB::table('documents')
            ->join('document_student', 'documents.id', '=', 'document_student.document_id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->where('title', 'like', '%' . $search_input . '%')
            ->orWhere('abstract', 'like', '%' . $search_input . '%')
            ->orWhere('field_topic', 'like', '%' . $search_input . '%')
            ->select('documents.id', 'documents.title', 'student.first_name', 'student.last_name')
            ->get();

        $hasResults = count($searchResults);

        return view('layouts.search-results', compact('searchResults', 'hasResults'));
    }

    public function document_info($id){
        $documentResults = DB::table('documents')
        ->join('document_student', 'documents.id', '=', 'document_student.document_id')
        ->join('student', 'document_student.student_id', '=', 'student.id')
        ->where('documents.id', '=', $id)
        ->select('documents.id', 'documents.title', 'documents.abstract', 'documents.field_topic', 'student.first_name', 'student.last_name', 'documents.created_at')
        ->first();
        
        return view('layouts.search-results', compact('documentResults'));
    }
}
