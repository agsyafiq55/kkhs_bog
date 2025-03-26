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
    <div class="container mx-auto px-4 py-8">
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                @if($event->thumbnail)
                <img src="data:image/jpeg;base64,{{ base64_encode($event->thumbnail) }}"
                    class="w-full rounded shadow-md"
                    alt="{{ $event->title }}" />
                @else
                <img src="http://velocityacademy.org/wp-content/uploads/2016/03/placeholder.jpg"
                    class="w-full rounded shadow-md"
                    alt="{{ $event->title }}" />
                @endif
            </div>

            <div>
                <h1 class="text-4xl font-bold mb-6">{{ $event->title }}</h1>
                <div class="mb-4">
                    <flux:badge color="{{ $tagColors[$event->tag] ?? 'zinc' }}" class="inline">{{ $event->tag }}</flux:badge>
                </div>

                <p class="text-lg mb-4">{{ $event->description }}</p>

                <div class="space-y-2">
                    <p><strong>Created on:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>