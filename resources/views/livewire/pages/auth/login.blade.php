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
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username"
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition duration-150"
                        placeholder="Email Address">
                </div>
                <x-input-error :messages="$errors->get('form.email')" class="mt-1 text-sm" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password"
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition duration-150"
                        placeholder="••••••••">
                </div>
                <x-input-error :messages="$errors->get('form.password')" class="mt-1 text-sm" />
            </div>

            <!-- Remember Me -->
            <div class="block mb-2"> <!-- Reduced margin -->
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded bg-white-900 border-black-300 text-red-600 shadow-sm focus:ring-red-500 h-3 w-3" name="remember"> <!-- Smaller checkbox -->
                    <span class="ms-2 text-base text-gray-600">{{ __('Remember me') }}</span> <!-- Smaller text -->
                </label>
            </div>

            <div class="flex items-center justify-end mb-2"> <!-- Reduced margin -->
                <x-primary-button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium hover:bg-red-700 transition duration-150" style="background-color: #800000; color: #FFFFFF;"> <!-- Smaller button -->
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Card Footer -->
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
            <a href="/welcome" class="inline-flex items-center text-sm text-gray-600 hover:text-[#800000] transition duration-150">
                <svg class="mr-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                Back to Home
            </a>
            <a href="/register" class="inline-flex items-center text-sm text-gray-600 hover:text-[#800000] transition duration-150">
                Create an account
                <svg class="ml-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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