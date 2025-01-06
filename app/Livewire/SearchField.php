<?php

namespace App\Livewire;

use Livewire\Component;

class SearchField extends Component
{
    public $selectedCategory = '';
    public $searchInput = '';

    public function search()
    {
        // Redirect to search route even if no category is selected
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
