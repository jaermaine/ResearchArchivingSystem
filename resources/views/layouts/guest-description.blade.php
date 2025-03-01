@section('content')
<div class="grid gap-6 lg:grid-cols-1 lg:gap-8">
    <a
        id="docs-card"
        class="flex flex-col lg:flex-row items-start gap-4 p-6 bg-white rounded-md shadow-lg ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20]">

        <!-- Image Container (Hidden on mobile) -->
        <div class="w-[210px] h-[434px] bg-[#C91F37] rounded-md flex items-center justify-center hidden lg:flex">
            <img class="w-[172px] h-[172px]" src="img/coecsa.png" alt="COECSA Logo" />
        </div>

        <!-- Text Container (Visible on all screen sizes) -->
        <div class="flex flex-col justify-start items-start">
            <br>
            <br>
            <br>
            <div class="text-black text-3xl font-semibold font-['Inter'] leading-9">Introduction</div>
            <div class="text-[#C91F37] text-lg font-semibold font-['Inter'] leading-7 mt-2">
                LPU Cavite-Archium is a Research Archiving System that aims to centralize the submission process and streamline the archiving of documents
            </div>
            <br>
            <br>
            <br>
            <!-- Getting Started Section -->
            <div class="text-black text-3xl font-semibold font-['Inter'] leading-9">Getting Started</div>
            <div class="text-[#C91F37] text-lg font-semibold font-['Inter'] leading-7 mt-2">
                Sign-in/Register to access full features
            </div>
        </div>
    </a>
</div>
@endsection