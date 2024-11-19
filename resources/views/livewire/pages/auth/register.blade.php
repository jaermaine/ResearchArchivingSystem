<?php

use App\Models\User;
use App\Models\Student;
use App\Models\Faculty;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'student'; // Default role
    public string $first_name = '';
    public string $last_name = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::min(8)
                ->mixedCase(1)
                ->symbols(1)
                ->numbers(1)],
            'role' => ['required', 'in:student,faculty'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        if ($validated['role'] === 'student') {
            Student::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'user_id' => $user->id,
                'document_id' => null,
                'department_id' => null,
            ]);
        } else {
            Faculty::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'user_id' => $user->id,
                'document_id' => null,
                'department_id' => null,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- First Name -->
        <div class = "mt-4">
            <x-input-label for="first_name" :value="__('First Name')" class="text-red-600" style="color: #b30000;" />
            <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" required autofocus autocomplete="name" style="color: black; border: 2px solid #b30000; background-color: #ffffff;" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class = "mt-4">
            <x-input-label for="first_name" :value="__('Last Name')" class="text-red-600" style="color: #b30000;" />
            <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" required autofocus autocomplete="last_name" style="color: black; border: 2px solid #b30000; background-color: #ffffff;" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-red-600" style="color: #b30000;" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" style="color: black; border: 2px solid #b30000; background-color: #ffffff; " />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-red-600" style="color: #b30000;" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" style="color: black; border: 2px solid #b30000; background-color: #ffffff; " />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-red-600" style="color: #b30000;" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" style="color: black; border: 2px solid #b30000; background-color: #ffffff; " />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" class="text-red-600" style="color: #b30000;" />
            <select wire:model="role" id="role" name="role" class="block mt-1 w-full" style="color: black; border: 2px solid #b30000; background-color: #ffffff;">
                <option value="student">{{ __('Student') }}</option>
                <option value="faculty">{{ __('Faculty') }}</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-red-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4" style="background-color: #b30000; color: #FFFFFF;">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>