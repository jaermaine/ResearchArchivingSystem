<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Documents;

class DocumentStatusController extends Component
{
    public function download($id){
        //
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
