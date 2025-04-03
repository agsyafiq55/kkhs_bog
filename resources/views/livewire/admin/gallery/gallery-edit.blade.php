<div>
    <div class="mb-6">
        <a href="{{ route('admin.gallery') }}" class="text-blue-600 hover:underline flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Gallery List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-semibold mb-6">{{ $galleryId ? 'Edit Gallery Image' : 'Add New Gallery Image' }}</h1>
        
        <form wire:submit.prevent="save">
            <div class="mb-4">
                <flux:label for="img_name">Image Name</flux:label>
                <flux:input id="img_name" wire:model="img_name" type="text" placeholder="Enter image name" />
                @error('img_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-4">
                <flux:label for="category">Category</flux:label>
                <flux:input id="category" wire:model="category" type="text" placeholder="Enter image category" />
                @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-4">
                <flux:label for="description">Description</flux:label>
                <flux:textarea id="description" wire:model="description" placeholder="Enter image description"></flux:textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-4">
                <flux:label for="newImage">Image</flux:label>
                <input type="file" wire:model="newImage" id="newImage" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100
                "/>
                @error('newImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                
                <div wire:loading wire:target="newImage" class="mt-2 text-sm text-blue-600">
                    Uploading...
                </div>
                
                @if($newImage)
                    <div class="mt-2">
                        <img src="{{ $newImage->temporaryUrl() }}" class="h-32 w-auto object-cover rounded-md">
                    </div>
                @elseif(isset($gallery) && $gallery->image)
                    <div class="mt-2">
                        <img src="data:image/jpeg;base64,{{ $gallery->image }}" class="h-32 w-auto object-cover rounded-md">
                    </div>
                @endif
            </div>
            
            <div class="flex space-x-2">
                <flux:button type="submit" variant="primary">
                    {{ $galleryId ? 'Update Image' : 'Add Image' }}
                </flux:button>
                
                <a href="{{ route('admin.gallery') }}">
                    <flux:button type="button">
                        Cancel
                    </flux:button>
                </a>
            </div>
        </form>
    </div>
</div>