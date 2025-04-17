<div class="py-6">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center mb-2">
                <flux:icon name="users" class="mr-3 text-indigo-600 dark:text-indigo-400" />
                <flux:heading size="xl" level="1" class="text-gray-800 dark:text-white">
                    {{ __('Board Members Management') }}</flux:heading>
            </div>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                {{ __('Manage board members information.') }}
            </p>
        </div>

        {{-- Search Bar --}}
        <div class="w-full sm:w-1/3">
            @livewire('search-bar', [
                'model' => 'Member',
                'searchFields' => ['member_name', 'position'],
            ])
        </div>

        <div>
            <flux:button href="{{ route('admin.aboutus.members.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                {{ __('Add Member') }}
            </flux:button>
        </div>
    </div>

    <flux:separator variant="subtle" class="mb-6" />

    <!-- Status Messages -->
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

    <!-- Members Section -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
        @php
            $positionColors = [
                'Chairman' => 'red',
                'Vice Chairman I' => 'indigo',
                'Vice Chairman II' => 'blue',
                'Secretary' => 'emerald',
                'Treasurer' => 'amber',
                'Supervision' => 'orange',
                'Member of Board of Governor' => 'violet',
            ];
        @endphp

        @if (count($members) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($members as $member)
                    <div
                        class="group relative bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-100 dark:border-zinc-700">
                        <div class="p-6">
                            <!-- Position badge -->
                            <flux:badge color="{{ $positionColors[$member->position] ?? 'zinc' }}"
                                class="absolute top-3 right-3 text-sm">
                                {{ $member->position === 'Member of Board of Governor' ? 'Member' : $member->position }}
                            </flux:badge>

                            <!-- Member Photo - Centered and Rounded -->
                            <div class="flex justify-center mb-4">
                                <div
                                    class="relative w-[150px] h-[150px] rounded-full overflow-hidden bg-gray-100 dark:bg-zinc-800 border-4 border-white dark:border-zinc-700 shadow-md">
                                    <img src="data:image/jpeg;base64,{{ $member->photo }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        alt="{{ $member->member_name }}">
                                </div>
                            </div>

                            <!-- Member Content -->
                            <div class="text-center">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2 line-clamp-1">
                                    {{ $member->member_name }}
                                </h3>

                                <!-- Action Buttons -->
                                <div class="flex justify-center space-x-2 mt-4">
                                    <flux:button href="{{ route('admin.aboutus.members.edit', $member->id) }}"
                                        class="text-sm bg-transparent hover:bg-blue-50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline-block"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit
                                    </flux:button>
                                    <flux:button wire:click.stop="deleteMember({{ $member->id }})"
                                        class="text-sm bg-transparent hover:bg-red-50 dark:hover:bg-red-900 text-red-600 dark:text-red-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline-block"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Delete
                                    </flux:button>
                                </div>
                            </div>
                        </div>

                        <!-- Hover overlay for better UX -->
                        <div
                            class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity pointer-events-none">
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 dark:bg-zinc-900 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">No board members found</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by adding your first member.</p>
            </div>
        @endif
    </div>
</div>
