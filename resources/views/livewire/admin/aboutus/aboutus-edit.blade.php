<div class="py-6">
    <form wire:submit.prevent="save">
    <!-- Header section remains the same -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center mb-2">
                <flux:icon name="users" class="mr-3 text-indigo-600 dark:text-indigo-400" />
                <flux:heading size="xl" level="1" class="text-gray-800 dark:text-white">
                    {{ __('About Us Manager') }}</flux:heading>
            </div>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                {{ __('Manage organization information and chairman\'s message.') }}
            </p>
        </div>

        <flux:button href="{{ route('admin.aboutus') }}" class="bg-gray-600 hover:bg-gray-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            {{ __('Back to About Us') }}
        </flux:button>
    </div>

    <flux:separator variant="subtle" class="mb-6" />
    <div class="grid grid-cols-1 ">
        <!-- Right Column - Image Uploads and Actions -->
        <div class="space-y-6">
            <!-- Organization Section - Full Width -->
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                <flux:heading size="lg" class="mb-4">Organization Photo</flux:heading>

                <div>
                    <!-- Image Preview -->
                    <div
                        class="mb-4 relative rounded-lg overflow-hidden bg-gray-100 dark:bg-zinc-800 aspect-video flex items-center justify-center">
                        @if ($newOrganizationPhoto)
                            <img src="{{ $newOrganizationPhoto->temporaryUrl() }}" class="w-full h-full object-cover"
                                alt="Organization photo preview">
                        @elseif($aboutUsId && $aboutUs->organization_photo)
                            <img src="data:image/jpeg;base64,{{ $aboutUs->organization_photo }}"
                                class="w-full h-full object-cover" alt="Current organization photo">
                        @else
                            <div class="text-center p-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M8 12h.01M12 12h.01M16 12h.01M20 12h.01M4 12h.01M8 16h.01M12 16h.01" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No image selected</p>
                            </div>
                        @endif
                    </div>

                    <!-- File Upload -->
                    <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Upload Organization
                        Photo</flux:text>
                    <input type="file" wire:model="newOrganizationPhoto" id="organization_photo"
                        class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100
                                dark:text-gray-400 dark:file:bg-zinc-700 dark:file:text-zinc-100"
                        accept="image/*" />
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WebP - Max 5MB</p>
                    @error('newOrganizationPhoto')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Chairman Section - Two Columns -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Chairman Photo (1/3 width) -->
                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                    <flux:heading size="lg" class="mb-4">Chairman Photo</flux:heading>

                    <div>
                        <!-- Image Preview -->
                        <div
                            class="mb-4 relative rounded-lg overflow-hidden bg-gray-100 dark:bg-zinc-800 aspect-square flex items-center justify-center">
                            @if ($newChairmanPhoto)
                                <img src="{{ $newChairmanPhoto->temporaryUrl() }}" class="w-full h-full object-cover"
                                    alt="Chairman photo preview">
                            @elseif($aboutUsId && $aboutUs->chairman_photo)
                                <img src="data:image/jpeg;base64,{{ $aboutUs->chairman_photo }}"
                                    class="w-full h-full object-cover" alt="Current chairman photo">
                            @else
                                <div class="text-center p-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M8 12h.01M12 12h.01M16 12h.01M20 12h.01M4 12h.01M8 16h.01M12 16h.01" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No image selected</p>
                                </div>
                            @endif
                        </div>

                        <!-- File Upload -->
                        <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Upload Chairman
                            Photo</flux:text>
                        <input type="file" wire:model="newChairmanPhoto" id="chairman_photo"
                            class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-indigo-50 file:text-indigo-700
                                    hover:file:bg-indigo-100
                                    dark:text-gray-400 dark:file:bg-zinc-700 dark:file:text-zinc-100"
                            accept="image/*" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WebP - Max 5MB</p>
                        @error('newChairmanPhoto')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column - Chairman's Speech (2/3 width) -->
                <div class="lg:col-span-2 bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                    <flux:heading size="lg" class="mb-4">Chairman's Message</flux:heading>

                    <div class="space-y-5">
                        <div>
                            <flux:textarea wire:model="chairman_speech" id="chairman_speech"
                                placeholder="Enter the chairman's speech here..." rows="20" class="w-full h-full">
                            </flux:textarea>
                            @error('chairman_speech')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div
                class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                <flux:heading size="lg" class="mb-4">Actions</flux:heading>

                <div class="space-y-3">
                    <flux:button type="submit" wire:loading.attr="disabled"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 transition-colors text-center py-3">
                        <span wire:loading.remove wire:target="save">
                            {{ $aboutUsId ? 'Save Changes' : 'Save' }}
                        </span>
                        <span wire:loading wire:target="save">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Processing...
                        </span>
                    </flux:button>

                    <flux:button type="button" href="{{ route('admin.aboutus') }}"
                        class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-zinc-700 dark:hover:bg-zinc-600 dark:text-white transition-colors text-center py-3">
                        Cancel
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
