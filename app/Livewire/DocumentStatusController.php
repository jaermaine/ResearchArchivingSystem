<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Documents;
use Illuminate\Support\Facades\DB;

class DocumentStatusController extends Component
{
    public function download($id){
        $document = DB::table('document_student')
        ->where('document_id', '=', "{$id}")
        ->select('document_student.id', 'document_id', 'student_id')
        ->first();

        $file_name = "{$document->id}{$document->document_id}{$document->student_id}";

        return response()->download(public_path("files/{$file_name}.pdf"));
    }

    public function approve($id){
        $document = Documents::find($id);
        $document->document_status_id = 2;
        $document->save();

        return redirect()->back();
    }

    public function reject($id){
        $document = Documents::find($id);
        $document->document_status_id = 3;
        $document->save();

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.document-status-controller');
    }
}
