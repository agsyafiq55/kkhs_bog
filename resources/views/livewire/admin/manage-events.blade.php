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
    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-4">
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

        <!-- Tag Dropdown-->
        <div>
            <flux:text variant="strong" class="mb-2">Tag</flux:text>
            <flux:select id="tag" size="sm" wire:model="tag">
                <flux:select.option value="Choose Tag..">Choose Tag..</flux:select.option>
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
                id="article"
                wire:model="article"
                label="Article Content"
                placeholder="Write about what's happening in KKHS!"
            ></flux:textarea>
            @error('article') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <flux:text variant="strong" class="mb-2">Thumbnail</flux:text>
            
            <!-- Option 1: Try setting additional attributes on Flux input -->
            <!-- 
            <flux:input 
                type="file" 
                id="thumbnail" 
                wire:model="thumbnail" 
                class="border-none outline-none"
                accept="image/*"
            />
            -->
            
            <!-- Option 2: Use standard HTML input instead of Flux component -->
            <input 
                type="file" 
                id="thumbnail" 
                wire:model="thumbnail"
                class="block w-full text-sm text-gray-500
                       file:mr-4 file:py-2 file:px-4
                       file:rounded file:border-0
                       file:text-sm file:font-semibold
                       file:bg-blue-50 file:text-blue-700
                       hover:file:bg-blue-100"
                accept="image/*"
            />
            
            <small class="pl-0.5">PNG, JPG, WebP - Max 5MB</small>
            @error('thumbnail') <p class="text-red-500">{{ $message }}</p> @enderror
            
            <!-- Add image preview -->
            @if ($thumbnail && method_exists($thumbnail, 'temporaryUrl'))
                <div class="mt-2">
                    <p>Preview:</p>
                    <img src="{{ $thumbnail->temporaryUrl() }}" class="w-32 h-32 object-cover rounded" alt="Thumbnail preview">
                </div>
            @endif
        </div>

        <flux:button type="submit" class="bg-blue-500 text-white p-2 rounded">
            {{ $eventId ? 'Update Event' : 'Create Event' }}
        </flux:button>
    </form>

    <!--Existing Events-->
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-4">Existing Events</h2>
        <ul class="space-y-2">
            @foreach($events as $event)
                <li class="flex justify-between items-center p-4 border rounded">
                    <div>
                        <strong>{{ $event->title }}</strong> ({{ $event->event_date }})
                        <p>{{ $event->description }}</p>
                        
                        <!-- Display thumbnail if available -->
                        @if($event->thumbnail)
                            <div class="mt-1">
                                <img src="data:image/jpeg;base64,{{ base64_encode($event->thumbnail) }}" 
                                     class="w-16 h-16 object-cover rounded" alt="Event thumbnail">
                            </div>
                        @endif
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