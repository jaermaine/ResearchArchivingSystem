<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SearchField extends Component
{

    public $searchInput;

    public function search()
    {
        return redirect()->route('search-document', ['search_input' => $this->searchInput ?? '']);
    }

    public function render()
    {
        return view('livewire.search-field');
    }
}
