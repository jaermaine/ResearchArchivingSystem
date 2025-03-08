<?php

namespace App\Livewire;

use App\Models\DocumentStudent;
use App\Models\DocumentAdviser;
use Livewire\Component;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentStatusController extends Component
{
    public function download($id)
    {
        $document = DB::table('document_student')
            ->where('document_id', '=', "{$id}")
            ->select('document_student.id', 'document_id', 'student_id')
            ->first();

        $file_name = "{$document->id}{$document->document_id}{$document->student_id}";

        return response()->download(public_path("files/{$file_name}.pdf"));
    }

    public function approve($id)
    {
        $document = Documents::find($id);
        $document->document_status_id = 2;
        $document->save();

        $document_student = DB::table('document_student')
            ->where('document_id', '=', "{$id}")
            ->select('id', 'document_id', 'student_id')
            ->first();

        $file_name = "{$document_student->id}{$document_student->document_id}{$document_student->student_id}";
        $file_path = public_path("files/{$file_name}");
        
        if (!file_exists($file_path . '.pdf')) {
            return redirect()->back()->with('error', 'File not found.'); // Handle the error if the file does not exist
        }

        $compressed_folder = storage_path('compressed');
        if (!is_dir($compressed_folder)) {
            mkdir($compressed_folder, 0777, true); // Create the folder if it doesn't exist
        }

        $data = file_get_contents($file_path . '.pdf');
        $gzdata = gzencode($data, 9);
        $compressed_file_path = "{$compressed_folder}/{$file_name}.gz";
        file_put_contents($compressed_file_path, $gzdata);

        return redirect()->back();
    }

    public function reject($id)
    {
        $document = Documents::find($id);
        $document->document_status_id = 3;
        $document->save();

        return redirect()->back();
    }

    public function edit($id)
    {
        $document = Documents::find($id);
        $document->document_status_id = 1; // set status back to pending
        $document->save();
        return redirect()->back();
    }
    
    public function admin_edit(Request $request, $id)
    {
        $document = Documents::find($id);

        if (!$document) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        $request->validate([
            'status' => 'required|integer|in:1,2,3'
        ]);
        
        $document->document_status_id = $request->status;
        $document->save();

        return redirect()->back()->with('success', 'Document status updated.');
    }
    public function admin_delete($id)
    {
    $document = Documents::find($id);

    if (!$document) {
        return redirect()->back()->with('error', 'Document not found.');
    }
        try {
            DocumentStudent::where('document_id', $id)->delete();
            DocumentAdviser::where('document_id', $id)->delete();

            $document->delete();

            return redirect()->back()->with('success', 'Document deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the document.');
        }
    }
}
