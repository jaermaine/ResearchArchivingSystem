<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchDocumentsController extends Controller
{
    public function search_document(Request $request)
    {
        $searchInput = $request->input('search_input', '');
        $category = $request->input('category', '');

        $query = DB::table('documents')
            ->join('document_student', 'documents.id', '=', 'document_student.document_id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->where('document_status_id', '=', 2);

        // If no category is selected, fetch all documents
        if (!$category) {
            $searchResults = $query->select(
                'documents.id',
                'documents.title',
                'student.first_name',
                'student.last_name'
            )->get();

            $hasResults = count($searchResults);

            return view('layouts.search-results', compact('searchResults', 'hasResults'));
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
                case 'department':
                    $query->where('documents.field_topic', 'like', '%' . $searchInput . '%');
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
            ->where('documents.id', '=', $id)
            ->select('documents.id', 'documents.title', 'documents.abstract', 'documents.field_topic', 'student.first_name', 'student.last_name', 'documents.created_at')
            ->first();

        return view('layouts.search-results', compact('documentResults'));
    }
}
