<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Documents;
use App\Models\Adviser;
use App\Models\DocumentAdviser;
use App\Models\DocumentStudent;
use App\Services\CoAuthorService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DocumentController extends Controller
{

    public function submit_document(Request $request)
    {

        $co_authors = CoAuthorService::getCoAuthors();

        Log::info('Co-authors: ' . json_encode($co_authors));

        Log::info('Request: ' . json_encode($request->all()));

        $program_id = DB::table('student')
            ->where('user_id', '=', Auth::user()->id)
            ->value('program_id');

        $student_id = DB::table('student')
            ->where('user_id', '=', Auth::user()->id)
            ->value('id');

        $validated = $request->validate([
            'title' => 'required',
            'abstract' => 'required',
            'keyword' => 'required',
            'adviser' => 'required',
            'file' => 'required|file|mimes:pdf|max:20480'
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Create document
            $document = new Documents();
            $document->title = $request->input('title');
            $document->abstract = $request->input('abstract');
            $document->keyword = $request->input('keyword');
            $document->program_id = $program_id;
            $document->document_status_id = 1; // Pending status
            $document->save();

            // Create document-adviser relationship
            $document_adviser = new DocumentAdviser();
            $document_adviser->document_id = $document->id;
            $document_adviser->adviser_id = $request->input('adviser');
            $document_adviser->save();

            // Create document-student relationship (main author)
            $document_student = new DocumentStudent();
            $document_student->document_id = $document->id;
            $document_student->student_id = $student_id;
            $document_student->save();

            if (is_array($co_authors) && count($co_authors) > 0) {
                foreach ($co_authors as $co_author_id) {
                    $coAuthorRel = new DocumentStudent();
                    $coAuthorRel->document_id = $document->id;
                    $coAuthorRel->student_id = $co_author_id;
                    $coAuthorRel->save();
                }
            }

            // Handle file upload
            $file_address = "{$document_student->id}{$document->id}{$student_id}";
            $request->file('file')->move('files', "{$file_address}" . '.pdf');

            // Clear the session after successful submission
            Session::forget('selected_co_authors');

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Document submitted successfully!');
        } catch (\Exception $e) {
            // Roll back the transaction if something goes wrong
            DB::rollBack();
            Log::error('Error submitting document: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while submitting your document. Please try again.');
        }
    }
}
