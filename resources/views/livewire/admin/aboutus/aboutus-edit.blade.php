<div class="py-6">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center mb-2">
                <flux:icon name="document-text" class="mr-3 text-indigo-600 dark:text-indigo-400" />
                <flux:heading size="xl" level="1" class="text-gray-800 dark:text-white">
                    {{ $aboutUsId ? 'Edit About Us' : 'Create About Us' }}
                </flux:heading>
            </div>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                {{ __('Manage school about us information.') }}
            </p>
        </div>

        <flux:button href="{{ route('admin.aboutus') }}"
            class="bg-gray-600 hover:bg-gray-700 transition-colors">
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

    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg text-green-700 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg text-red-700 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="space-y-6">
            <!-- Content Section -->
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                <flux:heading size="lg" class="mb-4">About Us Information</flux:heading>

                <div class="space-y-5">
                    <!-- Year Input -->
                    <div>
                        <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Year</flux:text>
                        <flux:input type="text" id="year" wire:model="year" 
                            placeholder="Enter year" class="w-full" maxlength="9" />
                        @error('year')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Organization Photo -->
                    <div>
                        <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Organization Photo</flux:text>
                        <flux:input type="file" wire:model="newOrganizationPhoto" accept="image/*" class="w-full" />
                        @if($organization_photo)
                            <div class="mt-2">
                                <img src="data:image/jpeg;base64,{{ $organization_photo }}" 
                                     class="max-w-xs h-auto rounded-lg border border-gray-200 dark:border-zinc-700" 
                                     alt="Organization Photo">
                            </div>
                        @endif
                        @error('newOrganizationPhoto')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Chairman Photo -->
                    <div>
                        <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Chairman Photo</flux:text>
                        <flux:input type="file" wire:model="newChairmanPhoto" accept="image/*" class="w-full" />
                        @if($chairman_photo)
                            <div class="mt-2">
                                <img src="data:image/jpeg;base64,{{ $chairman_photo }}" 
                                     class="max-w-xs h-auto rounded-lg border border-gray-200 dark:border-zinc-700" 
                                     alt="Chairman Photo">
                            </div>
                        @endif
                        @error('newChairmanPhoto')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Chairman Speech -->
                    <div>
                        <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Chairman Speech</flux:text>
                        <flux:textarea wire:model="chairman_speech" rows="4" class="w-full" 
                            placeholder="Enter chairman's speech"></flux:textarea>
                        @error('chairman_speech')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Actions Section -->
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                <flux:heading size="lg" class="mb-4">Actions</flux:heading>

                <div class="space-y-3">
                    <flux:button type="submit" wire:loading.attr="disabled"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 transition-colors text-center py-3">
                        <span wire:loading.remove wire:target="save">
                            {{ $aboutUsId ? 'Update About Us' : 'Create About Us' }}
                        </span>
                        <span wire:loading wire:target="save">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
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

            @if ($debugInfo)
                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                    <flux:heading size="lg" class="mb-4">Debug Info</flux:heading>
                    <div class="text-xs font-mono overflow-x-auto">
                        <pre>{{ $debugInfo }}</pre>
                    </div>
                </div>
            @endif
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Initialize CKEditor for both content fields
    ClassicEditor
        .create(document.querySelector('#content'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
                @this.set('content', editor.getData());
            });
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#zh_content'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
                @this.set('zh_content', editor.getData());
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush