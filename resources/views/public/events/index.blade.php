@php
    // Map event tags to badge colors
    $tagColors = [
        'Sports' => 'blue',
        'Education' => 'emerald',
        'Technology' => 'cyan',
        'Culture' => 'amber',
        'Entertainment' => 'fuchsia',
        'Health' => 'green',
        'Business' => 'rose',
        'Environment' => 'lime',
        'Art' => 'purple',
        'Science' => 'indigo',
    ];
@endphp

<x-layouts.app>
    <div class="mx-auto max-w-6xl">
        <div
            class="bg-white dark:bg-zinc-900 rounded-xl shadow-md border border-gray-100 dark:border-zinc-800 relative overflow-hidden">
            <!-- Background image with overlay -->
            <div class="absolute inset-0 z-0">
                <img src="https://www.resourcesgroups.com/wp-content/uploads/2020/12/Acadmic-events.jpg"
                    alt="Chinese landscape" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-white/80 dark:bg-zinc-900/80"></div>
            </div>
            <div class="flex flex-col md:flex-row relative z-10">
                <div class="md:w-2/3 p-8 flex flex-col justify-center">
                    <h1 class="text-8xl font-bold mb-2">Events</h1>
                    <h2 class="text-6xl font-semibold">事件</h2>
                </div>
                <div class="md:w-1/3 p-8 flex items-center">

                </div>
            </div>
        </div>

        <!-- Events Section -->
        <div class="mt-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach ($events as $event)
                    <a href="{{ route('events.show', $event->id) }}" class="block hover:no-underline h-full group">
                        <article
                            class="relative overflow-hidden rounded-lg shadow-md border border-gray-100 dark:border-zinc-800 transition-all duration-300 hover:shadow-xl hover:scale-102 h-96 bg-white dark:bg-zinc-900">
                            <!-- Background Image -->
                            <div class="h-48 overflow-hidden">
                                <img alt="{{ $event->title }}"
                                    src="{{ $event->thumbnail ? 'data:image/jpeg;base64,' . $event->thumbnail : 'http://velocityacademy.org/wp-content/uploads/2016/03/placeholder.jpg' }}"
                                    class="w-full h-full object-cover transition duration-700 ease-out group-hover:scale-105" />
                            </div>

                            <!-- Content Section -->
                            <div class="p-5">
                                <div class="mb-3">
                                    <flux:badge color="{{ $tagColors[$event->tag] ?? 'zinc' }}"
                                        class="inline-block text-sm">
                                        {{ $event->tag }}
                                    </flux:badge>
                                </div>

                                <h3 class="line-clamp-2 text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                    {{ $event->title }}
                                </h3>

                                <p class="line-clamp-2 text-sm/relaxed text-gray-600 dark:text-gray-300">
                                    {{ $event->description }}
                                </p>
                            </div>
                        </article>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- No events available message -->
        @if ($events->isEmpty())
            <div class="text-center mt-8">
                <p class="text-gray-500">No events available at the moment.</p>
            </div>
        @endif
    </div>
    </div>
</x-layouts.app>
