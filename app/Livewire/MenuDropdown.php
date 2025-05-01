<?php

namespace App\Livewire;

use App\Models\Adviser;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function Pest\Laravel\post;

class MenuDropdown extends Component
{
    public function render()
    {
        $user = Auth::user();

        // Check if the user is a student or adviser
        if($user->role == 'student') {
            $student = Student::where('user_id', $user->id)->first();
            $first_name = $student->first_name;
            $last_name = $student->last_name;
            $information = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'profile_picture' => $user->profile_picture,
            ];
        } elseif($user->role == 'adviser') {
            $adviser = Adviser::where('user_id', $user->id)->first();
            $first_name = $adviser->first_name;
            $last_name = $adviser->last_name;
            $information = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'profile_picture' => $user->profile_picture,
            ];
        } else {
            $userType = 'admin';
        }

        return view('livewire.menu-dropdown', [
            'information' => $information,
            'user' => $user,
            'first_name' => $first_name ?? null,
            'last_name' => $last_name ?? null,
        ]);
    }
}
