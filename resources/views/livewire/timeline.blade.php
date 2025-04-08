<!-- resources/views/livewire/public/timeline.blade.php -->
<div class="container mx-auto py-12 px-4">
    <div class="relative ">
        <!-- Timeline Line -->
        <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-px bg-gray-300"></div>

        <div class="relative">
            @foreach ($timelineCards as $index => $card)
                <div class="mb-16 relative">
                    <div class="absolute left-1/2 transform -translate-x-1/2 -mt-1">
                        <div class="w-6 h-6 bg-white rounded-full border-4 border-gray-300"></div>
                    </div>

                    <div class="flex items-center justify-center">
                        <div class="w-5/12 {{ $card->side === 'right' ? 'order-1' : 'order-3' }}">
                            @if ($card->side === 'left')
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <h3 class="text-3xl font-bold mb-2">{{ $card->year }}</h3>
                                    <h4 class="font-bold mb-2">{{ $card->title }}</h4>
                                    @if ($card->description)
                                        <p class="text-gray-700">{{ $card->description }}</p>
                                    @endif
                                    @if ($card->description_zh)
                                        <p class="text-gray-700 mt-2">{{ $card->description_zh }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="w-2/12 order-2 flex justify-center"></div>

                        <div class="w-5/12 {{ $card->side === 'left' ? 'order-1' : 'order-3' }}">
                            @if ($card->side === 'right')
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <h3 class="text-3xl font-bold mb-2">{{ $card->year }}</h3>
                                    <h4 class="font-bold mb-2">{{ $card->title }}</h4>
                                    @if ($card->description)
                                        <p class="text-gray-700">{{ $card->description }}</p>
                                    @endif
                                    @if ($card->description_zh)
                                        <p class="text-gray-700 mt-2">{{ $card->description_zh }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
