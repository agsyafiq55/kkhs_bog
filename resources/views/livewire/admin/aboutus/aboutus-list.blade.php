<div class="py-6">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center mb-2">
                <flux:icon name="users" class="mr-3 text-indigo-600 dark:text-indigo-400" />
                <flux:heading size="xl" level="1" class="text-gray-800 dark:text-white">
                    {{ __('About Us Management') }}</flux:heading>
            </div>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('Manage organization information and chairman\'s message.') }}
            </p>
        </div>

        <div>
            @if($aboutUs)
                <flux:button wire:click="edit" class="bg-indigo-600 hover:bg-indigo-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    {{ __('Edit About Us') }}
                </flux:button>
            @else
                <flux:button href="{{ route('admin.aboutus.edit') }}" class="bg-indigo-600 hover:bg-indigo-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Create About Us') }}
                </flux:button>
            @endif
        </div>
    </div>

    <flux:separator variant="subtle" class="mb-6" />

    <!-- Status Messages -->
    @if(session()->has('message'))
        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg text-green-700 dark:text-green-400">
            {{ session('message') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg text-red-700 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif

    @if($aboutUs)
        <div class="space-y-8">
            <!-- Organization Photo -->
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                <flux:heading size="lg" class="mb-4">Organization Photo</flux:heading>
                <div class="aspect-video bg-gray-100 dark:bg-zinc-800 rounded-lg overflow-hidden mb-4">
                    <img src="data:image/jpeg;base64,{{ $aboutUs->organization_photo }}" 
                         alt="Organization Photo" 
                         class="w-full h-full object-contain">
                </div>
            </div>

            <!-- Chairman Photo and Speech Combined -->
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                <flux:heading size="lg" class="mb-4">Chairman's Message</flux:heading>
                <div class="flex flex-col items-center gap-6">
                    <div class="w-48">
                        <div class="rounded-full overflow-hidden bg-gray-100 dark:bg-zinc-800 aspect-square">
                            <img src="data:image/jpeg;base64,{{ $aboutUs->chairman_photo }}" 
                                alt="Chairman Photo" 
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="prose max-w-none bg-gray-50 dark:bg-zinc-800 p-6 rounded-lg">
                            <p class="whitespace-pre-line text-gray-700 dark:text-gray-300">{{ $aboutUs->chairman_speech }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 text-sm text-gray-500 dark:text-gray-400 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Last updated: {{ $aboutUs->updated_at->format('F j, Y, g:i a') }}
                </div>
            </div>
            
            <!-- Members Section -->
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                <div class="flex justify-between items-center mb-6">
                    <flux:heading size="lg">Board Members</flux:heading>
                    <flux:button href="{{ route('admin.aboutus.members.create') }}" class="bg-indigo-600 hover:bg-indigo-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Add Member') }}
                    </flux:button>
                </div>
                
                @if(count($members) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($members as $member)
                            <div class="bg-gray-50 dark:bg-zinc-800 rounded-lg p-4 flex flex-col items-center">
                                <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-100 dark:bg-zinc-700 mb-4">
                                    <img src="data:image/jpeg;base64,{{ $member->photo }}" 
                                        alt="{{ $member->member_name }}" 
                                        class="w-full h-full object-cover">
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $member->member_name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $member->position }}</p>
                                
                                <div class="flex space-x-2 mt-auto">
                                    <flux:button href="{{ route('admin.aboutus.members.edit', $member->id) }}" variant="filled" size="sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit
                                    </flux:button>
                                    <flux:button wire:click="deleteMember({{ $member->id }})" 
                                                wire:confirm="Are you sure you want to delete {{ $member->member_name }}?"
                                                variant="danger" 
                                                size="sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Delete
                                    </flux:button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 dark:bg-zinc-800 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">No members have been added yet.</p>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-12 border border-gray-100 dark:border-zinc-700 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p class="text-gray-500 dark:text-gray-400 mb-6">No About Us information has been created yet.</p>
            <flux:button href="{{ route('admin.aboutus.edit') }}" class="bg-indigo-600 hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                {{ __('Create About Us') }}
            </flux:button>
        </div>
    @endif

    @if($debugInfo)
        <div class="mt-8 p-4 bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-gray-700 dark:text-gray-300">
            <h3 class="text-lg font-semibold mb-2">Debug Information</h3>
            <pre class="text-xs">{{ $debugInfo }}</pre>
        </div>
    @endif

    <livewire:timeline/>

</div>