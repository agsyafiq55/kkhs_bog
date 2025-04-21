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
        @livewire('public.events.events-list')
    </div>
</x-layouts.app>
