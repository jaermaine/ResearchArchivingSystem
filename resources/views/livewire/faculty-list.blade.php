<div class="mb-4">
    <label for="faculty" class="block text-gray-700">Faculty</label>
    <select wire:model="faculty_id" id="faculty" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="" hidden>Select Faculty</option>
        @foreach ($this->faculties as $faculty)
        <option value="{{ $faculty->id }}">{{ $faculty->first_name . " " .$faculty->last_name}}</option>
        @endforeach
    </select>

</div>