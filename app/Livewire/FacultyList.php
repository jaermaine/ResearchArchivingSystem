<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Faculty;

class FacultyList extends Component
{

    #[Computed()]
    public function faculties(){
        return Faculty::all();
    }

    public function render()
    {
        return view('livewire.faculty-list');
    }
}
