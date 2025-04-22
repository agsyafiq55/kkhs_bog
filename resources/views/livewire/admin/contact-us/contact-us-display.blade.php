<div class="py-6">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center mb-2">
                <flux:icon name="phone" class="mr-3 text-indigo-600 dark:text-indigo-400" />
                <flux:heading size="xl" level="1" class="text-gray-800 dark:text-white">
                    {{ __('Contact Us Information') }}
                </flux:heading>
            </div>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                {{ __('View and manage contact information for the organization.') }}
            </p>
        </div>

        <flux:button href="{{ route('admin.contactus.edit', ['contactUsId' => $contactUs->id]) }}"
            class="bg-gray-600 hover:bg-gray-700 transition-colors">
            {{ __('Edit Contact Us') }}
        </flux:button>
    </div>

    <flux:separator variant="subtle" class="mb-6" />

    <!-- Display Contact Information -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
        <flux:heading size="lg" class="mb-4">Contact Information</flux:heading>

        @if ($contactUs)
            <div class="space-y-5">
                <div>
                    <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Address:</flux:text>
                    <p>{{ $contactUs->address }}</p>
                </div>

                <div>
                    <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Email:</flux:text>
                    <p>{{ $contactUs->email }}</p>
                </div>

                <div>
                    <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Phone Number 1:
                    </flux:text>
                    <p>{{ $contactUs->phone_no1 }}</p>
                </div>

                <div>
                    <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Phone Number 2:
                    </flux:text>
                    <p>{{ $contactUs->phone_no2 }}</p>
                </div>

                <div>
                    <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Maps Coordinate:
                    </flux:text>
                    <p><a href="{{ $contactUs->maps_coordinate }}" target="_blank">{{ __('View on Google Maps') }}</a>
                    </p>
                </div>
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">{{ __('No contact information available.') }}</p>
        @endif
    </div>
</div>
