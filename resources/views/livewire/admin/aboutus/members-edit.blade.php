<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">{{ $memberId ? 'Edit' : 'Create' }} Member</h1>
        <flux:button href="{{ route('admin.aboutus') }}" variant="filled">
            Back to About Us
        </flux:button>
    </div>

    @if(session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="save" class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <label for="member_photo" class="block text-sm font-medium text-gray-700 mb-2">Member Photo</label>
            @if($memberId && $member->photo)
                <div class="mb-3">
                    <p class="text-sm text-gray-500 mb-2">Current Photo:</p>
                    <img src="data:image/jpeg;base64,{{ $member->photo }}" 
                         alt="Current Member Photo" 
                         class="w-48 h-48 object-cover bg-gray-100 rounded-lg">
                </div>
            @endif
            <input type="file" wire:model="newPhoto" id="member_photo" 
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('newPhoto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            
            @if($newPhoto)
                <div class="mt-3">
                    <p class="text-sm text-gray-500 mb-2">Preview:</p>
                    <img src="{{ $newPhoto->temporaryUrl() }}" 
                         class="w-48 h-48 object-cover bg-gray-100 rounded-lg">
                </div>
            @endif
        </div>

        <div class="mb-6">
            <label for="member_name" class="block text-sm font-medium text-gray-700 mb-2">Member Name</label>
            <input type="text" wire:model="member_name" id="member_name" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   placeholder="Enter member name">
            @error('member_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Position</label>
            <input type="text" wire:model="position" id="position" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   placeholder="Enter member position">
            @error('position') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">
                {{ $memberId ? 'Update' : 'Create' }} Member
            </flux:button>
        </div>
    </form>

    @if($debugInfo)
        <div class="mt-8 p-4 bg-gray-100 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Debug Information</h3>
            <pre class="text-xs">{{ $debugInfo }}</pre>
        </div>
    @endif
</div>