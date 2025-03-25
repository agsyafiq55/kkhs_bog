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
    <h1 class="text-3xl font-semibold text-center mb-8">Events</h1>
    
    <!--Events Sections-->
    <div class="mt-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    @foreach($events as $event)
                        <article class="group flex rounded-radius max-w-sm flex-col overflow-hidden border border-outline bg-surface-alt dark:border-outline-dark dark:bg-surface-dark-alt">
                            <div class="h-44 md:h-64 overflow-hidden">
                                <img src="{{ $event->image_url ?? 'http://velocityacademy.org/wp-content/uploads/2016/03/placeholder.jpg' }}" class="object-cover transition duration-700 ease-out group-hover:scale-105" alt="{{ $event->title }}" />
                            </div>
                            <div class="flex flex-col gap-4 p-6">
                                <div class="inline-block items-end">
                                    <flux:badge color="{{ $tagColors[$event->tag] ?? 'zinc' }}" class="inline">{{ $event->tag }}</flux:badge>
                                </div>
                                <h3 class="text-xl font-bold">{{ $event->title }}</h3>
                                <p class="text-sm">{{ $event->description }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

    <!-- No events available message -->
    @if($events->isEmpty())
        <div class="text-center mt-8">
            <p class="text-gray-500">No events available at the moment.</p>
        </div>
    @endif
</div>
</x-layouts.app>
