<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Department;

class DepartmentList extends Component
{
    #[Computed()]
    public function departments(){
        return Department::all();
    }

    public function render()
    {
        return view('livewire.department-list');
    }
}
