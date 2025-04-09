<div class="py-6">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center mb-2">
                <flux:icon name="academic-cap" class="mr-3 text-indigo-600 dark:text-indigo-400" />
                <flux:heading size="xl" level="1" class="text-gray-800 dark:text-white">
                    {{ $isEdit ? __('Edit Academic Achievement') : __('Add Academic Achievement') }}</flux:heading>
            </div>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                {{ __('Manage academic achievements and examination results.') }}
            </p>
        </div>

        <div>
            <flux:button href="{{ route('admin.achievements.academic.index') }}"
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
                <!-- Exam Type -->
                <div>
                    <label for="examType" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Exam Type</label>
                    <select id="examType" wire:model="examType"
                        class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Exam Type</option>
                        <option value="SPM">SPM</option>
                        <option value="STPM">STPM</option>
                    </select>
                    @error('examType') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Year -->
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Year</label>
                    <select id="year" wire:model="year"
                        class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Year</option>
                        @for ($i = date('Y'); $i >= 2000; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    @error('year') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- GPS -->
                <div>
                    <label for="gps" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">GPS (Grade Point Score)</label>
                    <input type="number" step="0.01" min="0" max="5" id="gps" wire:model="gps"
                        class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="e.g., 4.46">
                    @error('gps') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Certificate Percentage -->
                <div>
                    <label for="certificatePercentage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Certificate Qualification Percentage</label>
                    <div class="relative">
                        <input type="number" step="0.01" min="0" max="100" id="certificatePercentage" wire:model="certificatePercentage"
                            class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="e.g., 81.7">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 dark:text-gray-400">%</span>
                        </div>
                    </div>
                    @error('certificatePercentage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Grades Section -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-3">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Grades & Student Counts</label>
                    <flux:button type="button" wire:click="addGrade" class="text-sm bg-indigo-600 hover:bg-indigo-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline-block" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Grade
                    </flux:button>
                </div>

                @error('grades') <span class="text-red-500 text-sm block mb-2">{{ $message }}</span> @enderror

                <div class="bg-gray-50 dark:bg-zinc-800 rounded-lg p-4 space-y-3">
                    @foreach ($grades as $index => $grade)
                        <div class="flex items-center gap-4 p-3 bg-white dark:bg-zinc-900 rounded-md shadow-sm">
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Grade</label>
                                <input type="text" wire:model="grades.{{ $index }}.grade"
                                    class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="e.g., 10A, 9A">
                                @error("grades.{$index}.grade") <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Student Count</label>
                                <input type="number" min="0" wire:model="grades.{{ $index }}.student_count"
                                    class="w-full rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Number of students">
                                @error("grades.{$index}.student_count") <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex items-end pb-1">
                                <button type="button" wire:click="removeGrade({{ $index }})"
                                    class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach

                    @if (count($grades) === 0)
                        <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                            <p>No grades added yet. Click "Add Grade" to start.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-end">
                <flux:button type="submit" class="bg-indigo-600 hover:bg-indigo-700 transition-colors">
                    {{ $isEdit ? __('Update Achievement') : __('Create Achievement') }}
                </flux:button>
            </div>
        </form>
    </div>
</div>