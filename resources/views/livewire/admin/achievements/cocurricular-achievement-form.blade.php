<div class="py-6">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center mb-2">
                <flux:icon name="trophy" class="mr-3 text-amber-600 dark:text-amber-400" />
                <flux:heading size="xl" level="1" class="text-gray-800 dark:text-white">
                    {{ $isEdit ? __('Edit Co-Curricular Achievement') : __('Add Co-Curricular Achievement') }}</flux:heading>
            </div>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                {{ __('Manage co-curricular achievements and competition results.') }}
            </p>
        </div>

        <div>
            <flux:button href="{{ route('admin.achievements.cocurricular.index') }}"
                class="bg-gray-600 hover:bg-gray-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                {{ __('Back to List') }}
            </flux:button>
        </div>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
        <form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Event Title -->
                <div class="md:col-span-2">
                    <label for="eventTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Event Title</label>
                    <input type="text" id="eventTitle" wire:model="eventTitle"
                        class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                        placeholder="Enter event title">
                    @error('eventTitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                    <div class="flex">
                        <select id="category" wire:model="category"
                            class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                            <option value="Robotics">Robotics</option>
                            <option value="Sports">Sports</option>
                            <option value="Debate">Debate</option>
                            <option value="Academic">Academic</option>
                            <option value="Arts">Arts</option>
                            <option value="Music">Music</option>
                            <option value="Leadership">Leadership</option>
                            <option value="Community Service">Community Service</option>
                        </select>
                    </div>
                    @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Placement Type -->
                <div>
                    <label for="placementType" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Placement Type</label>
                    <div class="flex">
                        <select id="placementType" wire:model="placementType"
                            class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="">Select Placement</option>
                            @foreach ($placementTypes as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                            <option value="Gold">Gold</option>
                            <option value="Silver">Silver</option>
                            <option value="Bronze">Bronze</option>
                            <option value="Scholarship">Scholarship</option>
                            <option value="First Place">First Place</option>
                            <option value="Second Place">Second Place</option>
                            <option value="Third Place">Third Place</option>
                            <option value="Honorable Mention">Honorable Mention</option>
                        </select>
                    </div>
                    @error('placementType') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Student Count -->
                <div>
                    <label for="studentCount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Number of Students Awarded</label>
                    <input type="number" min="1" id="studentCount" wire:model="studentCount"
                        class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                        placeholder="Enter number of students">
                    @error('studentCount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Event Date -->
                <div>
                    <label for="eventDate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Event Date</label>
                    <input type="date" id="eventDate" wire:model="eventDate"
                        class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    @error('eventDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description (Optional)</label>
                    <textarea id="description" wire:model="description" rows="4"
                        class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-amber-500 focus:ring-amber-500"
                        placeholder="Enter additional details about this achievement"></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <flux:button type="submit" class="bg-amber-600 hover:bg-amber-700 transition-colors">
                    {{ $isEdit ? __('Update Achievement') : __('Create Achievement') }}
                </flux:button>
            </div>
        </form>
    </div>
</div>