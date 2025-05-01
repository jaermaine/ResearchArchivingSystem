@section('content')
<div class="overflow-hidden bg-white rounded-xl shadow-lg border border-gray-100">
    <div class="flex flex-col lg:flex-row">
        <!-- Left Side (Image) - Visible on all screens, but positioned differently -->
        <div class="relative bg-gradient-to-br from-[#800000] to-[#C91F37] lg:w-1/3">
            <div class="flex items-center justify-center h-48 lg:h-full overflow-hidden">
                <img class="w-32 h-32 lg:w-48 lg:h-48 object-contain filter drop-shadow-lg transform transition duration-500 hover:scale-105"
                    src="img/coecsa.png" alt="COECSA Logo" />
            </div>
            <!-- Decorative Elements -->
            <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-[#800000] rounded-full opacity-20"></div>
            <div class="absolute top-10 -left-6 w-16 h-16 bg-[#800000] rounded-full opacity-10"></div>
        </div>

        <!-- Right Side (Content) -->
        <div class="p-8 lg:p-10 lg:w-2/3 flex flex-col justify-center">
            <!-- Introduction Section -->
            <div class="mb-8">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-4">
                    Welcome to LPU Cavite-Archium
                </h2>
                <p class="text-base lg:text-lg text-gray-600 leading-relaxed">
                    A Research Archiving System that centralizes the submission process and
                    streamlines the archiving of academic documents.
                </p>
            </div>

            <!-- Features Section -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Key Features</h3>
                <ul class="space-y-2">
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-[#800000] mt-0.5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-600">Streamlined document submission</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-[#800000] mt-0.5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-600">Secure document archiving</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-[#800000] mt-0.5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-600">Advanced search capabilities</span>
                    </li>
                </ul>
            </div>

            <!-- Getting Started Section -->
            @auth
            @php
                $user = Auth::user();
                $userId = $user->id;
                $role = $user->role;
                
                if ($role == 'student') {
                    $first_name = \App\Models\Student::where('user_id', $userId)->first()->first_name;
                } elseif($role == 'adviser') {
                    $first_name = \App\Models\Adviser::where('user_id', $userId)->first()->first_name;
                }else{
                    $first_name = "User";
                }
            @endphp
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Getting Started</h3>
                <p class="text-gray-600 mb-6">
                    Welcome back, <strong>{{ $first_name }}!</strong>
                        You can now access your dashboard.
                </p>
                <a href = "/dashboard"
                    class="inline-flex items-center px-6 py-3 bg-[#800000] text-white rounded-lg shadow-md hover:bg-red-700 transition duration-300">
                    Go to Dashboard
                </a>
            </div>
            @else
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Getting Started</h3>
                <p class="text-gray-600 mb-6">
                    Sign in or register to access the full features of our research archiving system.
                </p>
                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-6 py-3 bg-[#800000] text-white rounded-lg shadow-md hover:bg-red-700 transition duration-300">
                        <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center px-6 py-3 bg-white text-[#800000] border border-[#800000] rounded-lg hover:bg-gray-50 transition duration-300">
                        <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                        </svg>
                        Register
                    </a>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection