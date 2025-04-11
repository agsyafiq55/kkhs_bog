<x-layouts.app>
    <x-slot name="title">Announcements</x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">School Announcements</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Stay updated with the latest news and announcements</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($announcements as $announcement)
                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm overflow-hidden border border-gray-100 dark:border-zinc-700 transition-all hover:shadow-md">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="data:image/jpeg;base64,{{ $announcement->image }}" alt="{{ $announcement->title }}" class="object-cover w-full h-full">
                    </div>
                    <div class="p-6">
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                            {{ $announcement->published_at->format('F d, Y') }}
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ $announcement->title }}</h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                            {{ \Illuminate\Support\Str::limit($announcement->content, 150) }}
                        </p>
                        <a href="{{ route('announcements.show', $announcement->id) }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
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