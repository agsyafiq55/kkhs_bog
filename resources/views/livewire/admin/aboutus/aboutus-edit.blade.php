<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">{{ $aboutUsId ? 'Edit' : 'Create' }} About Us</h1>
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
            <label for="organization_photo" class="block text-sm font-medium text-gray-700 mb-2">Organization Photo</label>
            @if($aboutUsId && $aboutUs->organization_photo)
                <div class="mb-3">
                    <p class="text-sm text-gray-500 mb-2">Current Photo:</p>
                    <img src="data:image/jpeg;base64,{{ $aboutUs->organization_photo }}" 
                         alt="Current Organization Photo" 
                         class="w-full max-h-64 object-contain bg-gray-100 rounded-lg">
                </div>
            @endif
            <input type="file" wire:model="newOrganizationPhoto" id="organization_photo" 
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('newOrganizationPhoto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            
            @if($newOrganizationPhoto)
                <div class="mt-3">
                    <p class="text-sm text-gray-500 mb-2">Preview:</p>
                    <img src="{{ $newOrganizationPhoto->temporaryUrl() }}" 
                         class="w-full max-h-64 object-contain bg-gray-100 rounded-lg">
                </div>
            @endif
        </div>

        <div class="mb-6">
            <label for="chairman_photo" class="block text-sm font-medium text-gray-700 mb-2">Chairman Photo</label>
            @if($aboutUsId && $aboutUs->chairman_photo)
                <div class="mb-3">
                    <p class="text-sm text-gray-500 mb-2">Current Photo:</p>
                    <img src="data:image/jpeg;base64,{{ $aboutUs->chairman_photo }}" 
                         alt="Current Chairman Photo" 
                         class="w-full max-h-64 object-contain bg-gray-100 rounded-lg">
                </div>
            @endif
            <input type="file" wire:model="newChairmanPhoto" id="chairman_photo" 
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('newChairmanPhoto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            
            @if($newChairmanPhoto)
                <div class="mt-3">
                    <p class="text-sm text-gray-500 mb-2">Preview:</p>
                    <img src="{{ $newChairmanPhoto->temporaryUrl() }}" 
                         class="w-full max-h-64 object-contain bg-gray-100 rounded-lg">
                </div>
            @endif
        </div>

        <div class="mb-6">
            <label for="chairman_speech" class="block text-sm font-medium text-gray-700 mb-2">Chairman's Speech</label>
            <textarea wire:model="chairman_speech" id="chairman_speech" rows="10" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                      placeholder="Enter the chairman's speech here..."></textarea>
            @error('chairman_speech') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">
                {{ $aboutUsId ? 'Update' : 'Create' }} About Us
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