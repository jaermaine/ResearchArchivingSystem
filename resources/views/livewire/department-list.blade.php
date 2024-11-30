<div class="mt-4">
    <x-input-label for="departments" :value="__('Departments')" class="text-red-600" style="color: #b30000;" />
    <select wire:model="department_id" id="departments" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="logSelectedDepartment(this)">
        <option value="" hidden>Select Department</option>
        @foreach ($departments as $department)
        <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('departments')" class="mt-2" />
</div>