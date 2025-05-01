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

@section('title', 'Login Page' )

<div class="min-h-screen flex flex-col items-center justify-center py-6 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Card -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Logo Section -->
            <div class="pt-6 pb-4 px-4 border-b border-gray-100 flex justify-center">
                <img class="w-[280px] h-auto sm:w-[320px]" src="img/lpuc-logo.png" alt="LPU Logo" />
            </div>

            <!-- Login form card -->
            <div class="bg-white py-5 px-4 sm:px-6 shadow rounded-lg">
                <form wire:submit="login" class="space-y-4">
                    @csrf
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition duration-150"
                                placeholder="Email Address">
                            <x-input-error :messages="$errors->get('form.email')" class="mt-1 text-sm" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition duration-150"
                                placeholder="••••••••">
                            <x-input-error :messages="$errors->get('form.password')" class="mt-1 text-sm" />
                        </div>
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

                    <!-- Footer Links -->
                    <div class="mt-4 pt-3 border-t border-gray-100">
                        <div class="flex justify-between items-center">
                            <a href="/welcome" class="inline-flex items-center text-sm text-gray-600 hover:text-[#800000] transition duration-150">
                                <svg class="mr-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="15 18 9 12 15 6" />
                                </svg>
                                Back to Home
                            </a>
                            <a href="/register" class="inline-flex items-center text-sm text-gray-600 hover:text-[#800000] transition duration-150">
                                Create an account
                                <svg class="ml-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="9 18 15 12 9 6" />
                                </svg>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>