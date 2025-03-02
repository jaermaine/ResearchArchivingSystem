<?php

namespace App\Livewire;

use Livewire\Component;

use function Pest\Laravel\post;

class MenuDropdown extends Component
{
    public function render()
    {
        return view('livewire.menu-dropdown');
    }
}
