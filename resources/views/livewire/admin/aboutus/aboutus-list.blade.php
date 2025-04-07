<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">About Us Management</h1>
        <div>
            @if($aboutUs)
                <flux:button wire:click="edit" variant="primary">
                    Edit About Us
                </flux:button>
            @else
                <flux:button href="{{ route('admin.aboutus.edit') }}" variant="primary">
                    Create About Us
                </flux:button>
            @endif
        </div>
    </div>

    @if(session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if($aboutUs)
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Organization Photo</h2>
                <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden mb-4">
                    <img src="data:image/jpeg;base64,{{ $aboutUs->organization_photo }}" 
                         alt="Organization Photo" 
                         class="w-full h-full object-contain">
                </div>

                <h2 class="text-xl font-semibold mb-4">Chairman Photo</h2>
                <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden mb-4">
                    <img src="data:image/jpeg;base64,{{ $aboutUs->chairman_photo }}" 
                         alt="Chairman Photo" 
                         class="w-full h-full object-contain">
                </div>

                <h2 class="text-xl font-semibold mb-4">Chairman's Speech</h2>
                <div class="prose max-w-none bg-gray-50 p-4 rounded-lg">
                    <p class="whitespace-pre-line">{{ $aboutUs->chairman_speech }}</p>
                </div>

                <div class="mt-4 text-sm text-gray-500">
                    Last updated: {{ $aboutUs->updated_at->format('F j, Y, g:i a') }}
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <p class="text-gray-500 mb-4">No About Us information has been created yet.</p>
            <flux:button href="{{ route('admin.aboutus.edit') }}" variant="primary">
                Create About Us
            </flux:button>
        </div>
    @endif

    @if($debugInfo)
        <div class="mt-8 p-4 bg-gray-100 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Debug Information</h3>
            <pre class="text-xs">{{ $debugInfo }}</pre>
        </div>
    @endif
</div>