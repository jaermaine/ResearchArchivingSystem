<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Documents;
use App\Models\Adviser;
use App\Models\DocumentAdviser;
use App\Models\DocumentStudent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function submit_document(Request $request)
    {
        $student_id = DB::table('student')
            ->where('user_id', '=', Auth::user()->id)
            ->value('id');

        // $co_author_id = $request->input('co_author');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'keyword' => 'required|string',
            'adviser' => 'required|integer',
            'file' => 'required|file|mimes:pdf|max:20480' // Adjust mime types as needed
        ]);

        $document = Documents::create([
            'title' => $validated['title'],
            'abstract' => $validated['abstract'],
            'keyword' => $validated['keyword'],
            'document_status_id' => 1
        ]);

        DocumentAdviser::create([
            'document_id' => $document->id,
            'adviser_id' => $validated['adviser']
        ]);

        $document_student = DocumentStudent::create([
            'document_id' => $document->id,
            'student_id' => $student_id
        ]);

        $file_address = "{$document_student->id}{$document->id}{$student_id}";

        $request->file('file')->move('files', "{$file_address}" . '.pdf');

        // Redirect or return a response
        return redirect()->back()
            ->with('success', 'Document submitted successfully!');
    }
    
}
