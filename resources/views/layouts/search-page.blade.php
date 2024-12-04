<div class="w-full md:w-[1250px] h-[500px] p-6 bg-white rounded-md shadow border border-[#ffcccc] flex flex-col justify-start items-center gap-2.5 overflow-y-auto">
    @foreach($searchResults as $result)
    <div class="w-full md:w-[900px] h-auto relative mb-4 p-4 bg-white rounded-md shadow">
        <div class="text-black text-xl font-semibold">
            {{ $result->title }}
        </div>
        <div class="text-black text-xl font-semibold mt-2">
            {{ $result->last_name }}{{','}} {{ $result->first_name }}
        </div>
        <form action="{{ route('document-info', ['id' => $result->id]) }}" method="GET">
            @csrf
            <input type="hidden" name="id" value="{{ $result->id }}">
            <div class="text-black text-base md:text-xl font-semibold mt-4">
                <button type="submit" class="text-[#ff3333]">Read More</button>
            </div>
        </form>
    </div>
</div>
@endforeach