<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Department;

class DepartmentList extends Component
{
    public $department_id;

    public function render()
    {
        return view('livewire.department-list', ['departments' => Department::all()]);
    }
}
