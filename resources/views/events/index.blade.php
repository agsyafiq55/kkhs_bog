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

    <!-- Events Section -->
    <div class="mt-6">
        <flux:heading size="xl">Events</flux:heading>
        <flux:heading size="lg">Explore what's happening in KKHS.</flux:heading>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
            @foreach($events as $event)
            <a href="{{ route('events.show', $event->id) }}" class="block hover:no-underline h-full group">
                <article class="relative overflow-hidden rounded-lg shadow-sm transition-transform duration-300 hover:shadow-lg hover:scale-105 h-96">
                    <!-- Background Image -->
                    <img
                        alt="{{ $event->title }}"
                        src="{{ $event->thumbnail ? 'data:image/jpeg;base64,' . base64_encode($event->thumbnail) : 'http://velocityacademy.org/wp-content/uploads/2016/03/placeholder.jpg' }}"
                        class="absolute inset-0 h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" />

                    <!-- Bottom Overlay with Gradient & Text -->
                    <div class="absolute bottom-0 left-0 right-0">
                        <div class="bg-gradient-to-t from-gray-900/50 to-gray-900/25 p-4 sm:p-6">
                            <flux:badge
                                color="{{ $tagColors[$event->tag] ?? 'zinc' }}"
                                class="inline-block text-sm text-white">
                                {{ $event->tag }}
                            </flux:badge>

                            <h3 class="mt-2 text-lg font-bold text-white">
                                {{ $event->title }}
                            </h3>

                            <!-- Truncate the description to avoid pushing the badge upward -->
                            <p class="mt-2 line-clamp-3 text-sm/relaxed text-white/95">
                                {{ $event->description }}
                            </p>
                        </div>
                    </div>
                </article>
            </a>
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