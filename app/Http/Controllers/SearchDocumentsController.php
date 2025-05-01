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
        $perPage = 3;

        // Base query with proper grouping
        $query = DB::table('documents')
            ->join('document_student', 'documents.id', '=', 'document_student.document_id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->select(
                'documents.id',
                'documents.title',
                'documents.abstract',
                'documents.keyword',
                'documents.created_at',
                DB::raw('GROUP_CONCAT(CONCAT(student.last_name, ", ", student.first_name) SEPARATOR " | ") as authors')
            )
            ->where('documents.document_status_id', '=', 2)
            ->groupBy('documents.id', 'documents.title', 'documents.abstract', 'documents.keyword', 'documents.created_at');

        // Apply category-specific filters if a category is selected
        if ($searchInput) {
            if ($category) {
                switch ($category) {
                    case 'title':
                        $query->where('documents.title', 'like', '%' . $searchInput . '%');
                        break;
                    case 'author':
                        $query->having('authors', 'like', '%' . $searchInput . '%');
                        break;
                    case 'keyword':
                        $query->where('documents.keyword', 'like', '%' . $searchInput . '%');
                        break;
                    case 'program':
                        $query->join('program', 'documents.program_id', '=', 'program.id')
                            ->where('program.name', 'like', '%' . $searchInput . '%');
                        break;
                    case 'date':
                        // Check if the search input is just a year
                        if (strlen($searchInput) == 4 && is_numeric($searchInput)) {
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
            } else {
                // If no specific category but there is search input, search across multiple fields
                $query->where(function ($q) use ($searchInput) {
                    $q->where('documents.title', 'like', '%' . $searchInput . '%')
                        ->orWhere('documents.keyword', 'like', '%' . $searchInput . '%');
                })
                    ->orHaving('authors', 'like', '%' . $searchInput . '%');
            }
        }

        $searchResults = $query->paginate($perPage);
        return view('layouts.search-results', compact('searchResults', 'category', 'searchInput'));
    }

    public function document_info($id)
    {
        // Get the document with all its contributing students
        $documentResults = DB::table('documents')
            ->join('document_student', 'documents.id', '=', 'document_student.document_id')
            ->join('student', 'document_student.student_id', '=', 'student.id')
            ->select(
                'documents.id',
                'documents.title',
                'documents.abstract',
                'documents.keyword',
                'documents.created_at',
                DB::raw('GROUP_CONCAT(CONCAT(student.last_name, ", ", student.first_name) SEPARATOR " | ") as authors')
            )
            ->where('documents.id', '=', $id)
            ->groupBy('documents.id', 'documents.title', 'documents.abstract', 'documents.keyword', 'documents.created_at')
            ->first();

        // Handle case when document is not found
        if (!$documentResults) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        return view('layouts.search-results', compact('documentResults'));
    }
}
