<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Student;
use App\Models\DocumentStudent;
use App\Services\CoAuthorService;
use Illuminate\Http\Request;

class CoAuthorModal extends Component
{
    use WithPagination;

    public $showModal = false;
    public $studentId;
    public $selected_co_authors = [];
    public $showConfirmation = false;

    // Initialize the component with student_id
    public function mount($studentId = null)
    {
        $this->studentId = $studentId;

        // Check if we have previously selected co-authors in the session
        if (Session::has('selected_co_authors')) {
            $this->selected_co_authors = Session::get('selected_co_authors');
        }
    }

    public function render()
    {
        $user = Auth::user();
        $userId = $user->id;
        $student = Student::where('user_id', $userId)->first();
        $program = $student->program_id;
        $year = $student->year_id;
        $section = $student->section_id;
        $students = Student::where('program_id', $program)
            ->where('year_id', $year)
            ->where('section_id', $section)
            ->where('user_id', '!=', $userId)
            ->paginate(5);

        // Get names of selected students for display
        $selectedStudentNames = [];
        if (!empty($this->selected_co_authors)) {
            $selectedStudentNames = Student::whereIn('id', $this->selected_co_authors)
                ->get()
                ->map(function ($student) {
                    return $student->first_name . ' ' . $student->last_name;
                })
                ->toArray();
        }

        return view('livewire.co-author-modal', [
            'students' => $students,
            'selectedStudentNames' => $selectedStudentNames,
        ]);
    }

    // Toggle modal
    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }

    // Toggle student selection
    public function toggleStudent($studentId)
    {
        // Convert to integer to ensure type consistency
        $studentId = (int) $studentId;

        if (in_array($studentId, $this->selected_co_authors)) {
            // Remove the student ID
            $this->selected_co_authors = array_values(array_diff($this->selected_co_authors, [$studentId]));
        } else {
            // Add the student ID
            $this->selected_co_authors[] = $studentId;
        }

        Log::info('Selected Co-Authors: ', $this->selected_co_authors);

        // Store in session right away
        Session::put('selected_co_authors', $this->selected_co_authors);
    }

    // Save selected co-authors
    public function saveCoAuthors()
    {
        // Skip validation for now - just log selections
        Log::info('Selected Co-Authors: ', $this->selected_co_authors);

        // Store in session
        Session::put('selected_co_authors', $this->selected_co_authors);

        CoAuthorService::setCoAuthors($this->selected_co_authors);

        Log::info('Co-Authors saved!');

        // Show confirmation message
        $this->showConfirmation = true;

        // Close the modal
        $this->showModal = false;
    }
}
