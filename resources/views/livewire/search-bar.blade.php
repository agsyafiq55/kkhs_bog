<div>
    <flux:input 
        wire:model.live.debounce.300ms="query"
        icon="magnifying-glass" 
        placeholder="Search..."
        class="w-full"
    />

    @if($query && count($results) > 0)
        <ul class="mt-2 border rounded shadow bg-white">
            @foreach($results as $item)
                <li class="p-2 border-b last:border-none hover:bg-gray-100">
                    {{ $item[$searchFields[0]] ?? 'N/A' }}
                </li>
            @endforeach
        </ul>
    @elseif($query)
        <div class="mt-2 text-sm text-gray-500">No results found.</div>
    @endif
</div>
