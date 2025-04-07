<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-center mb-8">About Us</h1>

        @if($aboutUs)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-10">
                <div class="md:flex">
                    <div class="md:w-2/3 bg-gray-100">
                        <img src="data:image/jpeg;base64,{{ $aboutUs->organization_photo }}" 
                             alt="Organization Photo" 
                             class="w-full h-full object-contain">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-10">
                <div class="md:flex">
                    <div class="md:w-1/3 bg-gray-100">
                        <img src="data:image/jpeg;base64,{{ $aboutUs->chairman_photo }}" 
                             alt="Chairman Photo" 
                             class="w-full h-full object-contain">
                    </div>
                    <div class="md:w-2/3 p-6">
                        <h2 class="text-2xl font-bold mb-4">Chairman's Speech</h2>
                        
                        <div class="prose max-w-none mt-4">
                            <p class="text-gray-600 whitespace-pre-line">{{ $aboutUs->chairman_speech }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500">No information available yet.</p>
            </div>
        @endif
    </div>
</x-layouts.app>