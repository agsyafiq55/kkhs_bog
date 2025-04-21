<div class="mx-auto max-w-6xl">
    <div
        class="bg-white dark:bg-zinc-900 rounded-xl mb-8 shadow-md border border-gray-100 dark:border-zinc-800 relative overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://img.freepik.com/free-photo/black-lives-matter-movement-message_23-2148913813.jpg?semt=ais_hybrid&w=740"
                alt="Chinese landscape" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-white/80 dark:bg-zinc-900/80"></div>
        </div>

        <div class="flex flex-col md:flex-row relative z-10">
            <div class="md:w-2/3 p-8 flex flex-col justify-center">
                <h1 class="text-8xl font-bold mb-2">Announcements</h1>
                <h2 class="text-6xl font-semibold">公告</h2>
            </div>
            <div class="md:w-1/3 p-8 flex items-center">
                {{-- Right description --}}
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="flex justify-center mt-8">
        <div class="w-full max-w-xl">
            <flux:input 
                wire:model.live="search"
                placeholder="Search by title or content..."
            />
        </div>
    </div>

    <!-- Loading Skeleton -->
    <div wire:loading.flex wire:target="search" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6 mx-auto max-w-6xl">
        @for ($i = 0; $i < 3; $i++)
            <div class="relative overflow-hidden rounded-lg shadow-md border border-gray-100 dark:border-zinc-800 h-96 bg-white dark:bg-zinc-900 animate-pulse w-full">
                <div class="h-48 bg-gray-200 dark:bg-zinc-900/50 w-full"></div>
                <div class="p-5 space-y-4">
                    <div class="h-6 bg-gray-200 dark:bg-zinc-800 rounded w-3/4"></div>
                    <div class="space-y-2">
                        <div class="h-4 bg-gray-200 dark:bg-zinc-800 rounded"></div>
                        <div class="h-4 bg-gray-200 dark:bg-zinc-800 rounded w-5/6"></div>
                    </div>
                    <div class="h-4 bg-gray-200 dark:bg-zinc-800 rounded w-1/4 mt-4"></div>
                </div>
            </div>
        @endfor
    </div>

    <!-- Results Grid -->
    <div wire:loading.remove wire:target="search" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        @forelse($announcements as $announcement)
            <a href="{{ route('announcements.show', $announcement->id) }}"
                class="block hover:no-underline h-full group">
                <article
                    class="relative overflow-hidden rounded-lg shadow-md border border-gray-100 dark:border-zinc-800 transition-all duration-300 hover:shadow-xl hover:scale-102 h-96 bg-white dark:bg-zinc-900">
                    <!-- Background Image -->
                    <div class="h-48 overflow-hidden">
                        <img src="data:image/jpeg;base64,{{ $announcement->image }}" alt="{{ $announcement->title }}"
                            class="w-full h-full object-cover transition duration-700 ease-out group-hover:scale-105">
                    </div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <h3
                            class="line-clamp-2 text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            {{ $announcement->title }}
                        </h3>

                        <p class="line-clamp-2 text-sm/relaxed text-gray-600 dark:text-gray-300">
                            {{ \Illuminate\Support\Str::limit($announcement->content, 150) }}
                        </p>

                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-3">
                            {{ $announcement->published_at->format('F d, Y') }}
                        </div>
                    </div>
                </article>
            </a>
        @empty
            <div class="col-span-full text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">No announcements found</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    @if ($search)
                        Try adjusting your search criteria.
                    @else
                        No announcements available at this time.
                    @endif
                </p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $announcements->links() }}
    </div>
</div>
