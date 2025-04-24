<div class="mx-auto max-w-6xl">
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-md border border-gray-100 dark:border-zinc-800 relative overflow-hidden">
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

    <!-- Filter Section -->
    <div class="mt-8 p-4 bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-800">
        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Category Filter -->
            <div class="w-full">
                <flux:select wire:model.live="selectedCategory" label="Filter by Category">
                    <option value="">All Categories</option>
                    @foreach ($availableCategories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </flux:select>
            </div>
        </div>
    </div>

    <!-- Loading Skeleton -->
    <div wire:loading.flex wire:target="selectedCategory"
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6 mx-auto">
        @for ($i = 0; $i < 3; $i++)
            <div
                class="relative overflow-hidden rounded-lg shadow-md border border-gray-100 dark:border-zinc-800 h-64 bg-white dark:bg-zinc-900 animate-pulse w-full">
                <div class="h-full bg-gray-200 dark:bg-zinc-900/50 w-full"></div>
            </div>
        @endfor
    </div>

    <!-- Gallery Content -->
    <div wire:loading.remove wire:target="selectedCategory">
        @if($images->isEmpty())
            <div class="text-center mt-8 p-8 bg-gray-50 dark:bg-zinc-800 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">No images found</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    @if ($selectedCategory)
                        Try selecting a different category.
                    @else
                        There are no images available at the moment.
                    @endif
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-8">
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
                                <div class="w-full {{ $randomHeight }} shadow-lg rounded-lg overflow-hidden relative transform-gpu preserve-3d perspective-1000 transition-all duration-500 ease-in-out cursor-pointer hover:rotate-y-10 hover:rotate-x-10 hover:scale-105 hover:shadow-lg group">
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
</div>