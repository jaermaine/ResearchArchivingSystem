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
use App\Rules\ValidEmail;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'student'; // Default role
    public string $first_name = '';
    public string $last_name = '';
    public string $suffix = ''; // Suffix

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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class, new ValidEmail],
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
            ]);
        } elseif ($validated['role'] === 'adviser') {
            Adviser::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'suffix' => $validated['suffix'] ?? null, // Ensure suffix is handled properly
                'user_id' => $user->id,
            ]);
        }

        Auth::logout();

        $this->redirect(route('login', absolute: false), navigate: true);
    }
};

?>

@section('title', 'Registration Page')

<div>

    <div>
        <img class="w-[350px] h-[120px] mx-auto" src="img/lpuc-logo.png" alt="LPU Logo" /> <!-- Reduced logo size -->

        <form wire:submit="register">
            @csrf
            <!-- Personal Information -->
            <div class="space-y-4">
                <h3 class="mt-6 text-sm font-medium text-gray-500 uppercase tracking-wider">Personal Information</h3>

                <div class="grid grid-cols-1 gap-4">
                    <!-- All name fields in same row -->
                    <div class="flex flex-col md:flex-row gap-4">
                        <!-- First Name (takes 40% of the row) -->
                        <div class="w-full md:w-2/5">
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input wire:model="first_name" id="first_name" type="text"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition duration-150"
                                required autofocus>
                            @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Name (takes 40% of the row) -->
                        <div class="w-full md:w-2/5">
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input wire:model="last_name" id="last_name" type="text"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition duration-150"
                                required>
                            @error('last_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Suffix (takes 20% of the row) -->
                        <div class="w-full md:w-1/5">
                            <label for="suffix" class="block text-sm font-medium text-gray-700 mb-1">Suffix</label>
                            <input wire:model="suffix" id="suffix" type="text"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition duration-150"
                                placeholder="Jr., Sr., etc.">
                            @error('suffix')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="space-y-4 pt-4">
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Account Information</h3>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input wire:model="email" id="email" type="email"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition duration-150"
                        required>
                    @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input wire:model="password" id="password" type="password"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition duration-150"
                        required>
                    @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input wire:model="password_confirmation" id="password_confirmation" type="password"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition duration-150"
                        required>
                    @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Role Selection - More Compact Design -->
            <div class="pt-2">
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Account Type</h3>

                <div class="flex gap-3 max-w-xl">
                    <!-- Student Option -->
                    <label class="flex-1 flex items-center p-3 bg-gray-50 border border-gray-200 rounded-lg cursor-pointer transition-all duration-200 hover:border-[#800000] hover:bg-red-50 {{ $role === 'student' ? 'ring-1 ring-[#800000] bg-red-50' : '' }}">
                        <input type="radio" wire:model.live="role" name="role" value="student" class="sr-only">
                        <div class="flex items-center justify-center w-8 h-8 mr-2 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Student</span>
                    </label>

                    <!-- Adviser Option -->
                    <label class="flex-1 flex items-center p-3 bg-gray-50 border border-gray-200 rounded-lg cursor-pointer transition-all duration-200 hover:border-[#800000] hover:bg-red-50 {{ $role === 'adviser' ? 'ring-1 ring-[#800000] bg-red-50' : '' }}">
                        <input type="radio" wire:model.live="role" name="role" value="adviser" class="sr-only">
                        <div class="flex items-center justify-center w-8 h-8 mr-2 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Adviser</span>
                    </label>
                </div>
                @error('role')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Register Button -->
            <div class="mt-6 flex items-center justify-end mb-2">
                <x-primary-button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#800000] hover:bg-[#6a0000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#800000] transition duration-150" style="background-color: #800000; color: #FFFFFF;">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
        <!-- Card Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
            <a href="/welcome" class="inline-flex items-center text-sm text-gray-600 hover:text-[#800000] transition duration-150">
                <svg class="mr-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                Back to Home
            </a>
            <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-[#800000] transition duration-150">
                Already have an account?
                <svg class="ml-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </a>
        </div>
    </div>
</div>