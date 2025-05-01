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
        if (keywords.length == 0) {
            document.getElementById("keywordInput").setAttribute('required', 'required');
        }
    }

    function updateKeywordList() {
        let keywordList = document.getElementById("keywordList");
        keywordList.innerHTML = ""; // Clear previous list

        keywordList.classList.add("flex", "flex-wrap", "gap-2", "mt-2");

        keywords.forEach((kw, index) => {
            let div = document.createElement("div");
            div.classList.add("bg-[#800000]", "text-white", "px-3", "py-1", "rounded-full", "flex", "items-center", "text-sm");

            div.innerHTML = `${kw} <button type="button" onclick="removeKeyword(${index})" class="ml-2 focus:outline-none hover:text-gray-200">&times;</button>`;
            keywordList.appendChild(div);
        });

        document.getElementById("keyword").value = keywords.toString();
    }

    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>

<div class="pt-16 sm:pt-20"> <!-- Added padding top -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header Section - Added better spacing and shadow -->
    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 mb-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">My Documents</h1>
            <button class="w-full sm:w-auto text-white py-2 sm:py-2.5 px-4 sm:px-5 rounded-lg bg-[#800000] hover:bg-red-700 shadow-md transition-all duration-300 flex items-center justify-center" onclick="openModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm sm:text-base">Submit New Document</span>
            </button>
        </div>
    </div>

    <!-- Documents Grid - Added container styling -->
    @if(!$documents->isEmpty())
    <div class="bg-gray-50 rounded-lg shadow-md p-4 sm:p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach($documents as $item)
            <!-- Document Card - Improved spacing and shadows -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-2 sm:items-center mb-4">
                        <h2 class="text-lg sm:text-xl font-bold text-gray-800">{{ $item->title }}</h2>
                        <span class="px-2 sm:px-3 py-1 text-xs font-semibold rounded-full whitespace-nowrap {{ $item->name == 'Approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $item->name }}
                        </span>
                    </div>

                    <div class="text-sm sm:text-base text-gray-600 mb-4 line-clamp-3">{{ $item->abstract }}</div>

                    <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-4">
                        @foreach(explode(',', $item->keyword) as $keyword)
                        <span class="px-2 sm:px-3 py-0.5 sm:py-1 bg-gray-100 text-gray-700 rounded-full text-xs">{{ trim($keyword) }}</span>
                        @endforeach
                    </div>

                    <div class="flex items-center text-sm sm:text-base text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="truncate">Adviser: {{ $item->first_name }} {{ $item->last_name }}</span>
                    </div>
                </div>

                <!-- Card Footer - Added consistent styling -->
                <div class="px-4 sm:px-6 py-3 bg-gray-50 border-t border-gray-100">
                    <form action="{{ route('document-info', ['id' => $item->id]) }}" method="GET">
                        <button type="submit" class="w-full text-[#800000] hover:text-red-700 font-medium text-sm flex items-center justify-center sm:justify-start">
                            <span>View Details</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State - Added container and better styling -->
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-600">No results found</h3>
            <p class="text-base text-gray-500 mt-2">Try adjusting your search criteria</p>
        </div>
        @endif

        <div class="px-4 sm:px-6 py-3 sm:py-4 divide-y divide-gray-100">
            {{ $documents->appends(request()->query())->links() }}
        </div>
    </div>
    @endsection

    @section('button')
    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-60 z-50 flex items-center justify-center hidden backdrop-blur-sm transition-all duration-300 p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-white px-4 sm:px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Submit Document</h2>
                    <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none p-2">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="px-4 sm:px-6 py-4 sm:py-6">
                <div class="space-y-6">
                    <!-- Co-author section -->
                    <livewire:co-author-modal />
                    <label class="block text-sm font-medium text-gray-700">Co-Authors</label>

                    <form method="POST" action="/submit-document" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="hidden" name="co_authors" id="co_authors_final" value="">

                        <!-- Title -->
                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" id="title" name="title"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition-colors text-sm sm:text-base"
                                placeholder="Enter the title of your document" required>
                        </div>

                        <!-- Abstract -->
                        <div class="space-y-2">
                            <label for="abstract" class="block text-sm font-medium text-gray-700">Abstract</label>
                            <textarea id="abstract" name="abstract" rows="4" sm:rows="6"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition-colors resize-none text-sm sm:text-base"
                                placeholder="Provide a brief summary of your document" required></textarea>
                        </div>

                        <!-- Keywords -->
                        <div class="space-y-2">
                            <label for="keywordInput" class="block text-sm font-medium text-gray-700">Keywords (max 5)</label>
                            <div class="flex flex-col sm:flex-row gap-2 sm:gap-0">
                                <input type="text" id="keywordInput"
                                    class="w-full sm:flex-grow px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg sm:rounded-r-none focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition-colors text-sm sm:text-base"
                                    placeholder="Enter a keyword" required>
                                <button type="button" onclick="addKeyword()"
                                    class="w-full sm:w-auto px-4 py-2 sm:py-3 bg-[#800000] text-white rounded-lg sm:rounded-l-none hover:bg-red-700 transition-colors text-sm sm:text-base">
                                    Add
                                </button>
                            </div>
                            <div id="keywordList" class="flex flex-wrap gap-2"></div>
                            <input type="hidden" id="keyword" name="keyword">
                        </div>

                        <!-- Adviser -->
                        <div class="space-y-2">
                            <label for="adviser" class="block text-sm font-medium text-gray-700">Adviser</label>
                            <select id="adviser" name="adviser"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition-colors appearance-none bg-white text-sm sm:text-base"
                                required>
                                <option value="" hidden>Select Adviser</option>
                                @foreach ($advisers as $adviser)
                                <option value="{{ $adviser->id }}">{{ $adviser->first_name . " " .$adviser->last_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- File Upload -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Upload File (*.pdf only)</label>
                            <div class="p-4 sm:p-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-2 text-center">
                                    <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex flex-col sm:flex-row items-center justify-center text-sm gap-1">
                                        <label for="file" class="cursor-pointer text-[#800000] hover:text-red-700 font-medium">
                                            <span>Upload a file</span>
                                            <input id="file" name="file" type="file" class="sr-only" accept=".pdf" required>
                                        </label>
                                        <p class="text-gray-600">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF up to 10MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 sm:gap-4 pt-4 border-t border-gray-200">
                            <button type="button"
                                class="w-full sm:w-auto px-4 py-2 sm:py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors text-sm sm:text-base"
                                onclick="closeModal()">
                                Cancel
                            </button>
                            <button type="submit"
                                class="w-full sm:w-auto px-4 sm:px-5 py-2 sm:py-2.5 bg-[#800000] text-white rounded-lg hover:bg-red-700 shadow-md transition-colors flex items-center justify-center text-sm sm:text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Submit Document
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('success'))
    <!-- Success Message Modal -->
    <div x-data="{ show: true }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        x-init="setTimeout(() => show = false, 3000)"
        class="fixed inset-0 z-50 overflow-y-auto"
        role="dialog"
        aria-modal="true">

        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal container -->
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-auto transform transition-all">
                <!-- Success icon -->
                <div class="p-4 sm:p-6 text-center">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-green-100 mx-auto mb-4 sm:mb-6">
                        <svg class="h-6 w-6 sm:h-8 sm:w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <!-- Content -->
                    <h2 class="text-lg sm:text-xl font-bold mb-2 text-gray-800">Submitted Successfully!</h2>
                    <p class="text-sm sm:text-base text-gray-600 mb-6">Your document has been submitted and is now pending approval.</p>

                    <!-- Close button -->
                    <button type="button"
                        @click="show = false"
                        class="w-full sm:w-auto px-4 sm:px-6 py-2 sm:py-2.5 bg-[#800000] text-white text-sm sm:text-base font-medium rounded-lg hover:bg-red-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#800000]">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @endsection