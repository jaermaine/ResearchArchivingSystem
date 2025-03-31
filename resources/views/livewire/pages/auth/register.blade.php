<?php

use App\Models\User;
use App\Models\Student;
use App\Models\Adviser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'student'; // Default role
    public string $first_name = '';
    public string $last_name = '';
    public string $department_id = ''; // Add department_id property
    public array $departments = [];
    public string $suffix = ''; // Suffix
     // public string $program_id = ''; // Add department_id property
    // public array $program = [];
    // public string $college_id = ''; // Add department_id property
    // public array $college = [];
    // public string $year_id = ''; // Add department_id property

    public function mount(): void
    {
        $this->program = DB::table('program')
            ->select("program.id", "program.name")
            ->get()
            ->toArray();
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'suffix' => ['nullable', 'string', 'max:30'], // Ensure suffix validation
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::min(8)
                ->mixedCase()
                ->symbols()
                ->numbers()],
            'role' => ['required', 'in:student,adviser'],
                        //'program_id' => ['required', 'exists:program,id'], // Add department_id validation
        ]);


        $validated['password'] = Hash::make($validated['password']);

        $user = User::create([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
        ]);

        if ($validated['role'] === 'student') {
            Student::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'suffix' => $validated['suffix'] ?? null, // Ensure suffix is handled properly
                'user_id' => $user->id,
                //'program_id' => $validated['college_id'],
                //'college_id' => $validated['college_id'], // Use validated department_id
            ]);
        } elseif ($validated['role'] === 'adviser') {
            Adviser::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'suffix' => $validated['suffix'] ?? null, // Ensure suffix is handled properly
                'user_id' => $user->id,
                //'college_id' => $validated['college_id'],
                //'department_id' => $validated['department_id'], // Use validated department_id
            ]);
        }


        Auth::logout();

        $this->redirect(route('login', absolute: false), navigate: true);
    }
};

?>

@section('title', 'Registration Page')

<div>
        <!-- FIXED HEADER - always stays at top -->
        <div class="w-full bg-white fixed top-0 left-0 right-0 p-2 z-20" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
            <div class="container mx-auto px-2 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="/welcome" class="text-xl font-bold text-[#b30000]">
                            <img class="w-[190px] h-[70px] sm:w-[260px] sm:h-[90px]" src="{{ asset('img/lpuc-logo.png') }}" alt="LPU Logo" />
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <div class="mt-2 mb-2">
        <img class="w-[350px] h-[120px] mx-auto" src="img/lpuc-logo.png" alt="LPU Logo" /> <!-- Reduced logo size -->

        <form wire:submit="register">
            @csrf
            <!-- First Name -->
            <div class="mb-2">
                <x-input-label for="first_name" :value="__('First Name')" class="text-red-600 text-2xl" style="color: #b30000;" />
                <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full h-8 text-sm" type="text" name="first_name" required autofocus autocomplete="name" style="color: black; border: 1px solid #b30000; background-color: #ffffff;" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-1 text-2xl"/>
            </div>

            <!-- Last Name -->
            <div class=" mb-2">
                    <x-input-label for="last_name" :value="__('Last Name')" class="text-red-600 text-2xl" style="color: #b30000;" />
                    <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full h-8 text-sm" type="text" name="last_name" required autofocus autocomplete="last_name" style="color: black; border: 1px solid #b30000; background-color: #ffffff;" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-1 text-2xl" />
            </div>

            <!-- Suffix -->
            <div class="mb-2">
                <x-input-label for="suffix" :value="__('Suffix')" class="text-red-600 text-2xl" style="color: #b30000;" />
                <x-text-input wire:model="suffix" id="suffix" class="block mt-1 w-full h-8 text-sm placeholder-gray-300" type="text" name="suffix" placeholder="Ex. Engr./Arch. (OPTIONAL)" autofocus autocomplete="name" style="color: black; border: 1px solid #b30000; background-color: #ffffff;" />
                <x-input-error :messages="$errors->get('suffix')" class="mt-1 text-2xl" />
            </div>

            <!-- Email Address -->
            <div class="mb-2">
                <x-input-label for="email" :value="__('Email')" class="text-red-600 text-2xl" style="color: #b30000;" />
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full h-8 text-sm" type="email" name="email" required autocomplete="username" style="color: black; border: 1px solid #b30000; background-color: #ffffff;" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-2xl" />
            </div>

            <!-- Password -->
            <div class="mb-2">
                <x-input-label for="password" :value="__('Password')" class="text-red-600 text-2xl" style="color: #b30000;" />
                <x-text-input wire:model="password" id="password" class="block mt-1 w-full h-8 text-sm" type="password" name="password" required autocomplete="new-password" style="color: black; border: 1px solid #b30000; background-color: #ffffff;" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-2xl" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-2">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-red-600 text-2xl" style="color: #b30000;" />
                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full h-8 text-sm" type="password" name="password_confirmation" required autocomplete="new-password" style="color: black; border: 1px solid #b30000; background-color: #ffffff;" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-2xl" />
            </div>

            <!-- Role -->
            <div class="mb-2">
                <x-input-label for="role" :value="__('Role')" class="text-red-600 text-2xl" style="color: #b30000;" />
                <select wire:model="role" id="role" name="role" class="block mt-1 w-full h-8 text-sm" style="color: black; border: 1px solid #b30000; background-color: #ffffff;">
                    <option value="student">{{ __('Student') }}</option>
                    <option value="adviser">{{ __('Adviser') }}</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-1 text-2xl" />
            </div>
            <br>
            <div class="flex items-center justify-end mb-2">
                <a class="underline text-xs text-gray-600 hover:text-red-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4 py-1 px-2 text-lg hover:bg-red-700" style="background-color: #800000; color: #FFFFFF;">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- FIXED FOOTER -->
    <div class="fixed bottom-0 left-0 right-0 py-4 bg-white text-center text-sm text-black z-10" style="box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
        Cloud-Based Research Archiving Systems: A Design Framework for Scalable Repositories
    </div>
</div>