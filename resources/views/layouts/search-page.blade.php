<div class="container mx-auto p-4">
    <div class="w-full md:w-[1250px] h-[500px] p-6 bg-white rounded-md shadow border border-[#ffcccc] flex flex-col justify-start items-center gap-2.5 overflow-y-auto">
        <div class="w-full md:w-[900px] h-auto relative mb-4 p-4 bg-white rounded-md shadow">
            @foreach($searchResults as $result)
            <div class="w-full md:w-[900px] h-auto relative mb-4 p-4 bg-white rounded-md shadow">
                <div class="text-black text-xl font-semibold">
                    {{ $result->title }}
                </div>
                <div class="text-black text-xl font-semibold mt-2">
                    {{ $result->last_name }}{{','}} {{ $result->first_name }}
                </div>
                <div class="text-black text-base md:text-xl font-semibold mt-4">
                    {{ $result->field_topic }}
                </div>
                <div class="text-black text-base md:text-xl font-semibold mt-4">
                    <a href="" class="text-[#ff3333]">Read More</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>