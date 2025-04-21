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

        <flux:button href="{{ route('admin.contactus.edit') }}"
            class="bg-gray-600 hover:bg-gray-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            {{ __('Edit Contact Us') }}
        </flux:button>
    </div>

    <flux:separator variant="subtle" class="mb-6" />

    <!-- Display Contact Information -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
        <flux:heading size="lg" class="mb-4">Contact Information</flux:heading>

        @if($contactUs)
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
                    <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Phone Number 1:</flux:text>
                    <p>{{ $contactUs->phone_no1 }}</p>
                </div>

                <div>
                    <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Phone Number 2:</flux:text>
                    <p>{{ $contactUs->phone_no2 }}</p>
                </div>

                <div>
                    <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Maps Coordinate:</flux:text>
                    <p><a href="{{ $contactUs->maps_coordinate }}" target="_blank">{{ __('View on Google Maps') }}</a></p>
                </div>
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">{{ __('No contact information available.') }}</p>
        @endif
    </div>
</div>