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
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($images as $image)
                <a href="{{ route('gallery.show', $image->id) }}" class="block">
                    <!-- Card with hover effect -->
                    <div class="w-full h-48 rounded-lg overflow-hidden relative transform-gpu preserve-3d perspective-1000 transition-all duration-500 ease-in-out cursor-pointer hover:rotate-y-10 hover:rotate-x-10 hover:scale-105 hover:shadow-lg group">
                        <!-- Background image with gradient overlay -->
                        <div class="absolute inset-0 overflow-hidden">
                            <img class="w-full h-full object-cover" 
                                 src="data:image/jpeg;base64,{{ $image->image }}" 
                                 alt="{{ $image->img_name }}">
                        </div>
                        
                        <!-- Gradient overlay that appears on hover -->
                        <div class="absolute inset-0 bg-gradient-to-br from-white/80 via-red-500/80 to-black/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Before pseudo-element -->
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/10 z-10 transform transition-transform duration-500 ease-in-out group-hover:-translate-x-full"></div>
                        
                        <!-- After pseudo-element -->
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/10 z-10 transform transition-transform duration-500 ease-in-out group-hover:translate-x-full"></div>
                        
                        <!-- Card content - only visible on hover -->
                        <div class="p-5 relative z-20 flex flex-col gap-2 items-center justify-center text-center h-full text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <h3 class="text-xl font-bold uppercase">{{ $image->img_name }}</h3>
                            @if($image->description)
                                <p class="text-white/80 text-sm">{{ Str::limit($image->description, 60) }}</p>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</x-layouts.app>