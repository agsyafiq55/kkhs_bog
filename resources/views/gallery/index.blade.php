<x-layouts.app>
    <h1 class="text-3xl font-semibold text-center mb-8">Gallery</h1>

    <div class="flex items-center justify-center py-4 md:py-8 flex-wrap gap-1.5">
        <flux:button href="{{ route('gallery') }}" 
                    variant="{{ !$selectedCategory ? 'primary' : 'filled' }}">
            All Categories
        </flux:button>
        
        @foreach($categories as $category)
            <flux:button href="{{ route('gallery', ['category' => $category]) }}"
                        variant="{{ $selectedCategory == $category ? 'primary' : 'filled'}}">
                {{ $category }}
            </flux:button>
        @endforeach
    </div>

    @if($images->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500">No images found in this category.</p>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $columns = [[], [], [], []];
                $i = 0;
                foreach($images as $image) {
                    $columns[$i % 4][] = $image;
                    $i++;
                }
            @endphp

            @foreach($columns as $column)
                <div class="grid gap-4">
                    @foreach($column as $image)
                        <div>
                            <a href="{{ route('gallery.show', $image->id) }}" class="block">
                                <img class="h-auto max-w-full rounded-lg hover:opacity-90 transition" 
                                     src="data:image/jpeg;base64,{{ $image->image }}" 
                                     alt="{{ $image->img_name }}">
                                <h3 class="mt-2 text-sm font-medium">{{ $image->img_name }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif
</x-layouts.app>