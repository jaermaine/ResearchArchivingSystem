<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Documents;
use App\Models\Faculty;
use App\Models\DocumentFaculty;
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

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'field_topic' => 'required|string',
            'faculty' => 'required|integer',
            //'file' => 'required|file|mimes:pdf,docx,doc' // Adjust mime types as needed
        ]);

        // Handle file upload (optional, if you want to store the file on the server)
        //$filePath = $request->file('file')->store('public/documents');

        $document = Documents::create([
            'title' => $validated['title'],
            'abstract' => $validated['abstract'],
            'field_topic' => $validated['field_topic'],
            'document_status_id' => 1
        ]);

        DocumentFaculty::create([
            'document_id' => $document->id,
            'faculty_id' => $validated['faculty']
        ]);

        DocumentStudent::create([
            'document_id' => $document->id,
            'student_id' => $student_id
        ]);

        // Create a new Document record
        // $document = new Documents;
        // $document->title = $validatedData['title'];
        // $document->abstract = $validatedData['abstract'];
        // $document->faculty = $validatedData['faculty'];
        // $document->file_path = $filePath; // If you're storing the file
        // $document->save();


        // Redirect or return a response
        return redirect()->back()
            ->with('success', 'Document submitted successfully!');
    }
}
