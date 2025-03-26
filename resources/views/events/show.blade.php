<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">{{ $event->title }}</h1>
        
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                @if($event->thumbnail)
                    <img src="data:image/jpeg;base64,{{ base64_encode($event->thumbnail) }}" 
                         class="w-full rounded-lg shadow-md" 
                         alt="{{ $event->title }}" />
                @else
                    <img src="http://velocityacademy.org/wp-content/uploads/2016/03/placeholder.jpg" 
                         class="w-full rounded-lg shadow-md" 
                         alt="{{ $event->title }}" />
                @endif
            </div>
            
            <div>
                <div class="mb-4">
                    <flux:badge color="{{ $tagColors[$event->tag] ?? 'zinc' }}" class="inline">{{ $event->tag }}</flux:badge>
                </div>
                
                <p class="text-lg mb-4">{{ $event->description }}</p>
                
                <div class="space-y-2">
                    <p><strong>Date:</strong> {{ $event->date }}</p>
                    <p><strong>Location:</strong> {{ $event->location }}</p>
                    <!-- Add more event details as needed -->
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>