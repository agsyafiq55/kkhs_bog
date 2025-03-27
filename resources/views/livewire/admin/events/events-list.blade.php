<div>
    <div class="mb-6 flex items-center justify-between">
        <flux:heading size="xl" level="1">{{ __('Existing Events') }}</flux:heading>
<flux:button href="{{ route('admin.events.create') }}">{{ __('Create New Event') }}</flux:button>
        </a>
    </div>
    <flux:separator variant="subtle" />

    <ul class="space-y-2">
        @foreach($events as $event)
            <li class="flex justify-between items-center p-4 border rounded cursor-pointer transition transform duration-200 hover:scale-105"
                wire:click="redirectToShow({{ $event->id }})">
                <div class="flex items-center">
                    <!-- Display thumbnail if available -->
                    @if($event->thumbnail)
                        <div>
                            <img src="data:image/jpeg;base64,{{ base64_encode($event->thumbnail) }}" 
                                 class="w-32 h-32 object-cover rounded" alt="Event thumbnail">
                        </div>
                    @endif
                    <div class="ml-3">
                        <strong>{{ $event->title }}</strong> ({{ $event->event_date }})
                        <p>{{ $event->description }}</p>
                    </div>
                </div>
                <div class="space-x-2">
                    <!-- Prevent card click when clicking these buttons -->
                    <flux:button wire:click.stop="edit({{ $event->id }})" class="text-blue-500">
                        Edit
                    </flux:button>
                    <flux:button wire:click.stop="delete({{ $event->id }})" class="text-red-500">
                        Delete
                    </flux:button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
