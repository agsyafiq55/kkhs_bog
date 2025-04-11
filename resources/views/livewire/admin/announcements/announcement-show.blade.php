<div class="p-6">
    <div class="mb-6">
        <flux:heading size="xl" level="1">{{ $announcement->title }}</flux:heading>
        <flux:subheading size="lg">{{ __('Announcement Details') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="mb-4">
        <flux:text variant="strong">Published At:</flux:text>
        <span>{{ $announcement->published_at->format('F d, Y H:i') }}</span>
    </div>

    <div class="mb-4">
        <flux:text variant="strong">Content:</flux:text>
        <p class="mt-2 whitespace-pre-line">{{ $announcement->content }}</p>
    </div>

    @if($announcement->image)
        <div class="mb-4">
            <flux:text variant="strong">Image:</flux:text>
            <div class="mt-2">
                <img src="data:image/jpeg;base64,{{ $announcement->image }}" 
                     class="max-w-full h-auto rounded-lg shadow-md" alt="Announcement image">
            </div>
        </div>
    @endif

    <div class="mt-6">
        <flux:button href="{{ route('admin.announcements') }}" class="bg-gray-500 text-white p-2 rounded">
            {{ __('Back to Announcements') }}
        </flux:button>
    </div>
</div>