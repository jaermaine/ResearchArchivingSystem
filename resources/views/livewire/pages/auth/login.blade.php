<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        Session::flush();

        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('welcome', absolute: false), navigate: true);
    }
}; ?>

@section('title', 'Login Page')

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

    <div class="mt-2 mb-2"> <!-- Added margin top to account for header -->
        <img class="w-[350px] h-[120px] mx-auto" src="img/lpuc-logo.png" alt="LPU Logo" /> <!-- Reduced logo size -->

        <!-- Session Status -->
        <x-auth-session-status class="mb-2" :status="session('status')" />

        <form wire:submit="login" class="max-w-sm mx-auto">
            @csrf
            <!-- Email Address -->
            <div class="mb-2"> <!-- Reduced margin -->
                <x-input-label for="email" :value="__('Email')" class="text-red-600 text-2xl" style="color: #b30000;" /> <!-- Smaller text -->
                <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full h-8 text-sm" type="email" name="email" required autofocus autocomplete="username" style="color: black; border: 1px solid #b30000; background-color: #ffffff;" /> <!-- Reduced height and border -->
                <x-input-error :messages="$errors->get('form.email')" class="mt-1 text-2xl" /> <!-- Smaller error text -->
            </div>

            <!-- Password -->
            <div class="mb-2"> <!-- Reduced margin -->
                <x-input-label for="password" :value="__('Password')" class="text-red-600 text-2xl" style="color: #b30000;" /> <!-- Smaller text -->

                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full h-8 text-sm"
                    type="password"
                    name="password"
                    required autocomplete="current-password" style="color: black; border: 1px solid #b30000; background-color: #ffffff;" /> <!-- Reduced height and border -->

                <x-input-error :messages="$errors->get('form.password')" class="mt-1 text-2xl" /> <!-- Smaller error text -->
            </div>

            <!-- Remember Me -->
            <div class="block mb-2"> <!-- Reduced margin -->
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded bg-white-900 border-black-300 text-red-600 shadow-sm focus:ring-red-500 h-3 w-3" name="remember"> <!-- Smaller checkbox -->
                    <span class="ms-2 text-base text-gray-600">{{ __('Remember me') }}</span> <!-- Smaller text -->
                </label>
            </div>

            <div class="flex items-center justify-end mb-2"> <!-- Reduced margin -->
                <x-primary-button class="ms-4 py-1 px-2 text-2xl" style="background-color: #800000; color: #FFFFFF;"> <!-- Smaller button -->
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
        <br>
        <div class="flex justify-between max-w-sm mx-auto">
            <a class="underline inline-flex items-center text-xs text-gray-600 hover:text-red-300" href="/welcome"> <!-- Smaller text -->
                <svg class="h-3 w-3 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <!-- Smaller icon -->
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                Back
            </a>
            <a class="underline inline-flex items-center text-xs text-gray-600 hover:text-red-300" href="/register"> <!-- Smaller text -->
                Continue to Registration
                <svg class="h-3 w-3 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <!-- Smaller icon -->
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </a>
        </div>
    </div>

    <!-- FIXED FOOTER -->
    <div class="fixed bottom-0 left-0 right-0 py-4 bg-white text-center text-sm text-black z-10" style="box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);">
        Cloud-Based Research Archiving Systems: A Design Framework for Scalable Repositories
    </div>
</div>