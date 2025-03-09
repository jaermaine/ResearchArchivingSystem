<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$student_id = DB::table('student')
    ->where('user_id', '=', Auth::user()->id)
    ->value('id');
$college_id = DB::table('student')
    ->where('user_id', '=', Auth::user()->id)
    ->value('college_id');

$advisers = DB::table('adviser')
    ->where('college_id', "=",  $college_id)
    ->select("adviser.id", "adviser.first_name", "adviser.last_name")
    ->get();
?>

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($documents as $item)
    <div class="bg-white rounded-md shadow-2xl p-6">
        <div class="font-bold">ID: {{ $item->id }}</div>
        <div class="font-semibold">Title: {{ $item->title }}</div>
        <div>Abstract: {{ $item->abstract }}</div>
        <div>Keyword: {{ $item->keyword }}</div>
        <div>Status: {{ $item->name }}</div>
        <div>Adviser Name: {{ $item->last_name }} {{ $item->first_name }}</div>
    </div>
    @endforeach
</div>
<div class="flex justify-end mb-4">
    <button class="text-white py-2 px-4 rounded bg-[#800000] hover:bg-red-700" onclick="openModal()">
        Submit Document
    </button>
</div>
@endsection

@section('button')

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl mx-4 sm:mx-6 md:mx-8 lg:mx-10 xl:mx-12 max-h-[80vh] overflow-y-auto">
        <h2 class="text-xl font-bold mb-4">Submit Document</h2>
        <form method="POST" action="/submit-document" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" id="title" name="title" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter the title of your document" required>
            </div>
            <div class="mb-4">
                <label for="abstract" class="block text-gray-700">Abstract</label>
                <textarea id="abstract" name="abstract" rows="8" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" placeholder="Provide a brief summary of your document" required></textarea>
            </div>

            <!-- Keywords -->
            <div class="mb-4">
                <label for="keyword" class="block text-gray-700">Keywords (max 5)</label>
                <div class="flex">
                    <input type="text" id="keywordInput" class="flex-grow px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter a keyword" required>
                    <button type="button" onclick="addKeyword()" class="bg-[#800000] text-white py-2 px-4 rounded hover:bg-red-700 ml-2">Add</button>
                </div>

                <!-- Keywords List (Horizontal) -->
                <div id="keywordList" class="flex flex-wrap gap-2 mt-2"></div>

                <!-- Hidden Input to Store Keywords -->
                <input type="hidden" id="keyword" name="keyword">

                <script>
                    let keywords = []; // Store keywords

                    function addKeyword() {
                        let input = document.getElementById("keywordInput");
                        let keywordList = document.getElementById("keywordList");

                        if (input.value.trim() !== "" && keywords.length < 5) {
                            keywords.push(input.value.trim()); // Add new keyword
                            document.getElementById("keywordInput").removeAttribute('required');
                            input.value = ""; // Clear input
                            updateKeywordList(); // Refresh display
                        } else if (keywords.length >= 5) {
                            alert("You can only input up to 5 keywords."); // Show popup alert
                        }
                    }

                    function removeKeyword(index) {
                        keywords.splice(index, 1); // Remove the keyword at the given index
                        updateKeywordList(); // Refresh display
                        if(keywords.length == 0){
                            document.getElementById("keywordInput").setAttribute('required', 'required');
                        }
                    }

                    function updateKeywordList() {
                        let keywordList = document.getElementById("keywordList");
                        keywordList.innerHTML = ""; // Clear previous list

                        keywordList.classList.add("flex", "flex-wrap", "gap-2", "mt-2");

                        keywords.forEach((kw, index) => {
                            let div = document.createElement("div");
                            div.classList.add("bg-[#800000]", "hover:bg-red-700", "text-white", "px-3", "py-1", "rounded-full", "flex", "items-center", "gap-2");

                            div.innerHTML = `${kw} <button type="button" onclick="removeKeyword(${index})" class="text-white font-bold ml-2">&times;</button>`;
                            keywordList.appendChild(div);
                        });

                        document.getElementById("keyword").value = keywords.toString();
                    }
                </script>
            </div>

            <div class="mb-4">
                <label for="adviser" class="block text-gray-700">Adviser</label>
                <select id="adviser" name="adviser" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" hidden>Select Adviser</option>
                    @foreach ($advisers as $adviser)
                    <option value="{{ $adviser->id }}">{{ $adviser->first_name . " " .$adviser->last_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="file" class="block text-gray-700">Upload File (*.pdf only)</label>
                <input type="file" id="file" name="file" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Upload your document in PDF format" required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 mr-2" onclick="closeModal()">Cancel</button>
                <button type="submit" class="bg-[#800000] text-white py-2 px-4 rounded hover:bg-red-700" wire:click="submitDocument">Submit</button>
            </div>
        </form>
    </div>
</div>

@if (session()->has('success'))
<div x-data="{ show: true }"
    x-show="show"
    x-transition
    x-init="setTimeout(() => show = false, 3000)"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm text-center">
        <h2 class="text-xl font-bold mb-4">Submitted Successfully!</h2>
        <p>Your document has been submitted.</p>
        <br>
        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 mr-2" @click="show : false">Close</button>
    </div>
</div>
@endif

@endsection