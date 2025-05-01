<div>
    <div class="flex items-center justify-between">
        <button wire:click="toggleModal" class="bg-[#800000] hover:bg-red-700 text-white px-4 py-2 rounded-md shadow-sm transition duration-200 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Select Co-Authors
        </button>
        
        <!-- Show selected co-authors count if any -->
        @if(count($selected_co_authors) > 0)
            <span class="ml-3 text-sm text-green-600 font-medium">
                {{ count($selected_co_authors) }} co-author{{ count($selected_co_authors) != 1 ? 's' : '' }} selected
            </span>
        @endif
    </div>
    
    <!-- Selected Co-Authors List -->
    @if(count($selectedStudentNames) > 0)
        <div class="mt-2 flex flex-wrap gap-2">
            @foreach($selectedStudentNames as $name)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    {{ $name }}
                </span>
            @endforeach
        </div>
    @endif
    
    <!-- Hidden form field to store selected co-authors -->
    <input type="hidden" name="co_authors" value="{{ json_encode($selected_co_authors) }}">

    @if($showModal)
        <!-- Modal Backdrop -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 flex items-center justify-center p-4">
            <!-- Modal Container -->
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-auto z-50 overflow-hidden">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-gray-800">Select Co-Authors</h3>
                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none" wire:click="toggleModal">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-4 max-h-[60vh] overflow-y-auto">
                    <!-- Student List Table -->
                    <div class="mb-4">
                        <div class="overflow-x-auto border border-gray-200 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Student
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Select
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($students as $student)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-[#800000] text-white flex items-center justify-center">
                                                        @include('layouts/profile-picture', ['user' => $student])
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $student->first_name }} {{ $student->last_name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <button wire:click="toggleStudent({{ $student->id }})"
                                                        class="px-2 py-1 {{ in_array($student->id, $selected_co_authors) ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} rounded-md transition-colors duration-200">
                                                    {{ in_array($student->id, $selected_co_authors) ? 'Selected' : 'Select' }}
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="px-6 py-4 text-center text-sm text-gray-500">
                                                No students available
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $students->links() }}
                        </div>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" 
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md transition duration-200"
                            wire:click="toggleModal">
                        Cancel
                    </button>
                    <button type="button" 
                            class="px-4 py-2 bg-[#800000] hover:bg-red-700 text-white rounded-md shadow-sm transition duration-200"
                            wire:click="saveCoAuthors">
                        Save Selection
                    </button>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Confirmation Message -->
    @if($showConfirmation)
        <div class="mt-2 p-2 bg-green-50 text-green-800 rounded-md">
            Co-authors have been selected. They will be saved when you submit the form.
        </div>
    @endif
</div>