<?php

namespace App\Livewire;

use Livewire\Component;

class SearchField extends Component
{
    public $selectedCategory;
    public $searchInput;

    public function mount()
    {
        //selected values will remain the same
        $this->selectedCategory = session('selectedCategory', '');
        $this->searchInput = session('searchInput', '');
    }

    public function search()
    {
        //store values remains the same after reloading/proceeding to another page
        session([
            'selectedCategory' => $this->selectedCategory
        ]);

        return redirect()->route('search.documents', [
            'category' => $this->selectedCategory,
            'search_input' => $this->searchInput,
        ]);
    }

    public function render()
    {
        return view('livewire.search-field');
    }
}
