<div>
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 relative overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.pexels.com/photos/5474047/pexels-photo-5474047.jpeg" alt="Chinese landscape" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-white/80 dark:bg-zinc-900/80"></div>
        </div>
            
        <div class="flex flex-col md:flex-row relative z-10">
            <div class="md:w-2/3 p-8 flex flex-col justify-center">
                <h1 class="text-8xl font-bold mb-2">Gallery</h1>
                <h2 class="text-6xl font-semibold">照片库</h2>
            </div>
            <div class="md:w-1/3 p-8 flex items-center">
                <p class="text-sm md:text-base text-justify">
                    Explore the mesmerizing sceneries and various facilities offered in Kota Kinabalu High School.
                    <br><br>
                    探索亚庇高中迷人的风景和各种设施。。
                </p>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-center py-4 md:py-8 flex-wrap gap-1.5">
        <flux:button wire:click="setCategory()" 
                    variant="{{ !$selectedCategory ? 'primary' : 'filled' }}">
            All Categories
        </flux:button>
        
        @foreach($categories as $category)
            <flux:button wire:click="setCategory('{{ $category }}')"
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
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @php
                // Group images into columns for better layout control
                $columns = [[], [], []];
                $i = 0;
                foreach($images as $image) {
                    $columns[$i % 3][] = $image;
                    $i++;
                }
                
                // Define possible height classes for randomization
                $heightClasses = ['h-48', 'h-56', 'h-64', 'h-72'];
            @endphp
            
            @foreach($columns as $column)
                <div class="flex flex-col gap-4">
                    @foreach($column as $image)
                        @php
                            // Randomly select a height class
                            $randomHeight = $heightClasses[array_rand($heightClasses)];
                        @endphp
                        
                        <a href="{{ route('gallery.show', $image->id) }}" class="block">
                            <!-- Card with hover effect -->
                            <div class="w-full {{ $randomHeight }} rounded-lg overflow-hidden relative transform-gpu preserve-3d perspective-1000 transition-all duration-500 ease-in-out cursor-pointer hover:rotate-y-10 hover:rotate-x-10 hover:scale-105 hover:shadow-lg group">
                                <!-- Background image with gradient overlay -->
                                <div class="absolute inset-0 overflow-hidden">
                                    <img class="w-full h-full object-cover" 
                                         src="data:image/jpeg;base64,{{ $image->image }}" 
                                         alt="{{ $image->img_name }}">
                                </div>
                                
                                <!-- Gradient overlay that appears on hover -->
                                <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
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
            @endforeach
        </div>
    @endif
</div>