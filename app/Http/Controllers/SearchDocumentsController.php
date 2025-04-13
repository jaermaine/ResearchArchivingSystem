<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchDocumentsController extends Controller
{
    public function search_document(Request $request)
    {
        $validated = $request->validate([
            'search_input' => 'nullable|string|max:255',
            'category' => 'nullable|string|in:title,author,keyword,program,date',
        ]);
        
        $searchInput = $request->input('search_input', '');
        $category = $request->input('category', '');

        $query = DB::table('documents')
            ->join('document_student', 'documents.id', '=', 'document_student.document_id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->join('program', 'documents.program_id', '=', 'program.id')
            ->where('document_status_id', '=', 2);
        
        if(!$category && $searchInput){
            $query
                ->where('documents.title', 'like', '%' . $searchInput . '%')
                ->orWhere(DB::raw("CONCAT(student.first_name, ' ', student.last_name)"), 'like', '%' . $searchInput . '%')
                ->orWhere('documents.keyword', 'like', '%' . $searchInput . '%')
                ->orWhere('documents.abstract', 'like', '%' . $searchInput . '%')
                ->orWhere('program.name', 'like', '%' . $searchInput . '%')
                ->orWhere('documents.created_at', 'like', '%' . $searchInput . '%');
        }

        // Apply category-specific filters if a category is selected
        if ($category && $searchInput) {
            switch ($category) {
                case 'title':
                    $query->where('documents.title', 'like', '%' . $searchInput . '%');
                    break;
                case 'author':
                    $query->where(DB::raw("CONCAT(student.first_name, ' ', student.last_name)"), 'like', '%' . $searchInput . '%');
                    break;
                case 'keyword':
                    $query->where('documents.keyword', 'like', '%' . $searchInput . '%');
                    break;
                case 'program':
                    $query
                    ->where('program.name', 'like', '%' . $searchInput . '%');
                    break;
                case 'date':
                    // Check if the search input is just a year
                    if (strlen($searchInput) == 4) {
                        // Match all documents in the given year (e.g., 2024)
                        $query->whereYear('documents.created_at', $searchInput);
                    } else {
                        // Otherwise, filter by exact date (YYYY-MM-DD)
                        if (strtotime($searchInput)) {
                            $query->whereDate('documents.created_at', $searchInput);
                        } else {
                            return back()->with('error', 'Invalid date format. Please use YYYY-MM-DD.');
                        }
                    }
                    break;
            }
        }

        $searchResults = $query->select(
            'documents.id',
            'documents.title',
            'student.first_name',
            'student.last_name'
        )->get();

        $hasResults = count($searchResults);

        return view('layouts.search-results', compact('searchResults', 'hasResults'));
    }


    public function document_info($id)
    {
        $documentResults = DB::table('documents')
            ->join('document_student', 'documents.id', '=', 'document_student.document_id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->select('documents.id', 'documents.title', 'documents.abstract', 'documents.keyword', 'student.first_name', 'student.last_name', 'documents.created_at')
            ->where('documents.id', '=', $id)
            ->first();

        return view('layouts.search-results', compact('documentResults'));
    }
}
