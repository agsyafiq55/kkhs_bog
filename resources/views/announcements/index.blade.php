<x-layouts.app>
    <div class="mx-auto max-w-6xl">
        <x-slot name="title">Announcements</x-slot>

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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @forelse($announcements as $announcement)
                <a href="{{ route('announcements.show', $announcement->id) }}" class="block hover:no-underline h-full group">
                    <article
                        class="relative overflow-hidden rounded-lg shadow-md border border-gray-100 dark:border-zinc-800 transition-all duration-300 hover:shadow-xl hover:scale-102 h-96 bg-white dark:bg-zinc-900">
                        <!-- Background Image -->
                        <div class="h-48 overflow-hidden">
                            <img src="data:image/jpeg;base64,{{ $announcement->image }}" alt="{{ $announcement->title }}"
                                class="w-full h-full object-cover transition duration-700 ease-out group-hover:scale-105">
                        </div>
                        
                        <!-- Content Section -->
                        <div class="p-5">
                            <h3 class="line-clamp-2 text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
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
                    <p class="text-gray-500 dark:text-gray-400">No announcements available at this time.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $announcements->links() }}
        </div>
    </div>
</x-layouts.app>
