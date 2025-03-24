<div>
    <div class="mb-6">
        <div class="relative mb-3 w-full flex items-center">
            <!-- Flux Icon on the left -->
            <flux:icon name="calendar" class="mr-3 mb-0.5" />

            <!-- Heading -->
            <flux:heading size="xl" level="1">{{ __('Events Manager') }}</flux:heading>
        </div>

        <flux:subheading size="lg" class="mb-6">{{ __('Create, View, Update or Delete Events.') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>


    <!-- Event Form -->
    <form wire:submit.prevent="save" class="space-y-4">
        <flux:heading class="mb-0">Event Details</flux:heading>
        <flux:text class="mt-1">Enter the details of the event.</flux:text>
        <div>
            <flux:text variant="strong" class="mb-2">Title</flux:text>
            <flux:input type="text" id="title" wire:model="title" class="border-none outline-none" />
            @error('title') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <flux:text variant="strong" class="mb-2">Description</flux:text>
            <flux:textarea id="description" wire:model="description" class="border-none outline-none"></flux:textarea>
            @error('description') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <flux:text variant="strong" class="mb-2">Event Date</flux:text>
            <flux:input type="date" id="event_date" wire:model="event_date" class="border-none outline-none" />
            @error('event_date') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <!-- Tag Dropdown using flux:select -->
        <div>
            <flux:text variant="strong" class="mb-2">Tag</flux:text>
            <flux:select wire:model="tag" placeholder="Choose Tag...">
                <flux:select.option value="Sports">Sports</flux:select.option>
                <flux:select.option value="Education">Education</flux:select.option>
                <flux:select.option value="Technology">Technology</flux:select.option>
                <flux:select.option value="Culture">Culture</flux:select.option>
                <flux:select.option value="Entertainment">Entertainment</flux:select.option>
                <flux:select.option value="Health">Health</flux:select.option>
                <flux:select.option value="Business">Business</flux:select.option>
                <flux:select.option value="Environment">Environment</flux:select.option>
                <flux:select.option value="Art">Art</flux:select.option>
                <flux:select.option value="Science">Science</flux:select.option>
            </flux:select>
            @error('tag') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
        <flux:separator variant="subtle" />
        <div mt-2>
            <flux:textarea
                label="Article Content"
                placeholder="Write about what's happening in KKHS!"
            />
            @error('article') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <flux:text variant="strong" class="mb-2">Thumbnail</flux:text>
            <flux:input type="file" id="thumbnail" wire:model="thumbnail" class="border-none outline-none" />
            <small class="pl-0.5">PNG, JPG, WebP - Max 5MB</small>
            @error('thumbnail') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <flux:button type="submit" class="bg-blue-500 text-white p-2 rounded">
            {{ $eventId ? 'Update Event' : 'Create Event' }}
        </flux:button>
    </form>

    <!-- Event List -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-4">Existing Events</h2>
        <ul class="space-y-2">
            @foreach($events as $event)
                <li class="flex justify-between items-center">
                    <div>
                        <strong>{{ $event->title }}</strong> ({{ $event->event_date }})
                        <p>{{ $event->description }}</p>
                    </div>
                    <div class="space-x-2">
                        <flux:button wire:click="edit({{ $event->id }})" class="text-blue-500">Edit</flux:button>
                        <flux:button wire:click="delete({{ $event->id }})" class="text-red-500">Delete</flux:button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
