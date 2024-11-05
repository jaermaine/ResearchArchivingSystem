<?php

use App\Models\User;
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

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::min(8)
                                                                            ->mixedCase(1)
                                                                            ->symbols(1)
                                                                            ->numbers(1)],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <h2 class="text-center text-4xl font-bold text-[#800000] mb-8">Create an account</h2>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-[#800000]" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full bg-[#d9d9d9]/0 border-[#800000] rounded-lg" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-[#800000]" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full bg-[#d9d9d9]/0 border-[#800000] rounded-lg" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-[#800000]" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full bg-[#d9d9d9]/0 border-[#800000] rounded-lg" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#800000]" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full bg-[#d9d9d9]/0 border-[#800000] rounded-lg" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-[#800000] hover:text-red-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-[#b30000] border-[#800000] text-white">
                {{ __('Register') }}
            </x-primary-button>
            
        </div>
    </form>
</div>