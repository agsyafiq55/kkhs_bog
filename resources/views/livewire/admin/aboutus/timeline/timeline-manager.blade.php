@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="py-6">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center mb-2">
                <flux:icon name="clock" class="mr-3 text-indigo-600 dark:text-indigo-400" />
                <flux:heading size="xl" level="1" class="text-gray-800 dark:text-white">
                    {{ __('Timeline Manager') }}</flux:heading>
            </div>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                {{ __('Create, View, Update or Delete Timeline Cards.') }}
            </p>
        </div>

        <flux:button href="{{ route('admin.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            {{ __('Back to Dashboard') }}
        </flux:button>
    </div>

    <flux:separator variant="subtle" class="mb-6" />

    <!-- Add form status messages -->
    @if (session()->has('message'))
        <div
            class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg text-green-700 dark:text-green-400">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div
            class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg text-red-700 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Timeline Form -->
        <div class="lg:col-span-2">
            <div
                class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700 mb-6">
                <flux:heading size="lg" class="mb-4">
                    {{ $editingCardId ? 'Edit Timeline Card' : 'Add New Timeline Card' }}</flux:heading>

                <form wire:submit.prevent="saveCard">
                    <div class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Year
                                </flux:text>
                                <flux:input type="number" wire:model="year" class="w-full" placeholder="Enter year" />
                                @error('year')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            
                        </div>


                        <div>
                            <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Description
                                (English)</flux:text>
                            <flux:textarea wire:model="description" class="w-full" rows="3"
                                placeholder="Enter description in English"></flux:textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <flux:text variant="strong" class="mb-2 block text-gray-700 dark:text-gray-300">Description
                                (Chinese)</flux:text>
                            <flux:textarea wire:model="description_zh" class="w-full" rows="3"
                                placeholder="Enter description in Chinese"></flux:textarea>
                            @error('description_zh')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column - Actions -->
        <div>
            <div
                class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700 mb-6">
                <flux:heading size="lg" class="mb-4">Actions</flux:heading>

                <div class="space-y-3">
                    <flux:button type="button" wire:click="saveCard" wire:loading.attr="disabled"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 transition-colors text-center py-3">
                        <span wire:loading.remove
                            wire:target="saveCard">{{ $editingCardId ? 'Update Card' : 'Add Card' }}</span>
                        <span wire:loading wire:target="saveCard">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Processing...
                        </span>
                    </flux:button>

                    @if ($editingCardId)
                        <flux:button type="button" wire:click="resetForm"
                            class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-zinc-700 dark:hover:bg-zinc-600 dark:text-white transition-colors text-center py-3">
                            Cancel
                        </flux:button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline Cards List -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700 mt-6">
        <flux:heading size="lg" class="mb-4">Timeline Cards</flux:heading>

        <div x-data="{
            init() {
                new Sortable(this.$refs.cardsList, {
                    animation: 150,
                    ghostClass: 'opacity-50',
                    onSort: (evt) => {
                        const orderedIds = Array.from(evt.to.children)
                            .map(item => item.getAttribute('data-id'));
                        @this.updateOrder(orderedIds);
                    }
                });
            }
        }">
            <ul x-ref="cardsList" class="space-y-4">
                @foreach ($cards as $card)
                    <li class="bg-gray-50 dark:bg-zinc-800 p-5 rounded-lg shadow-sm border border-gray-100 dark:border-zinc-700 flex justify-between items-center"
                        data-id="{{ $card->id }}">
                        <div>
                            <div class="flex items-center space-x-3 mb-2">
                                <span
                                    class="font-bold text-lg text-gray-800 dark:text-white">{{ $card->year }}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">{{ $card->description }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">{{ $card->description_zh }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <button wire:click="editCard({{ $card->id }})"
                                class="p-2 text-indigo-500 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </button>
                            <button wire:click="deleteCard({{ $card->id }})"
                                class="p-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors"
                                onclick="confirm('Are you sure you want to delete this card?') || event.stopImmediatePropagation()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="p-2 text-gray-500 dark:text-gray-400 cursor-move">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 8h16M4 16h16" />
                                </svg>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            @if (count($cards) === 0)
                <div
                    class="text-center p-8 bg-gray-50 dark:bg-zinc-800 rounded-lg border border-gray-100 dark:border-zinc-700">
                    <p class="text-gray-500 dark:text-gray-400">No timeline cards available yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
