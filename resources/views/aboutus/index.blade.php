<x-layouts.app>
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-2/3 p-8 flex flex-col justify-center">
                    <h1 class="text-8xl font-bold mb-2">About Us</h1>
                    <h2 class="text-6xl font-semibold">KKHS Board of Governors</h2>
                </div>
                <div class="md:w-1/3 p-8 flex items-center">
                    <p class="text-sm md:text-base text-justify">
                        Our diverse board that comprises of individuals from different background and industries is committed towards maintaining and developing the school and adding value to the development and well-being of the students.
                        <br><br>
                        我们多元化的董事会由来自不同背景和行业的组成，团结一致, 维持和发展学校, 提升学生的福利和全方位发展。
                    </p>
                </div>
            </div>
        </div>
    
    {{-- About us section --}}
    <div class="container mx-auto">
        @if ($aboutUs)
            <div class="space-y-8">
                <!-- Organization Photo -->
                <div
                    class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                    <div class="aspect-video bg-gray-100 dark:bg-zinc-800 rounded-lg overflow-hidden mb-4">
                        <img src="data:image/jpeg;base64,{{ $aboutUs->organization_photo }}" alt="Organization Photo"
                            class="w-full h-full object-contain">
                    </div>
                </div>

                <!-- Chairman Photo and Speech Combined -->
                <div
                    class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Chairman's Message</h2>
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="md:w-1/3 flex flex-col items-center">
                            <div class="w-64 mb-4">
                                <img src="data:image/jpeg;base64,{{ $aboutUs->chairman_photo }}" alt="Chairman Photo"
                                    class="w-full object-cover rounded-lg">
                            </div>
                            <div class="text-center">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Mr.
                                    {{ $aboutUs->chairman_name ?? 'Chairman' }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">KKHS BOG Chairman</p>
                            </div>
                        </div>
                        <div class="md:w-2/3">
                            <div class="prose max-w-none">
                                <p class="whitespace-pre-line text-gray-700 dark:text-gray-300 text-justify">
                                    {{ $aboutUs->chairman_speech }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Board Members Section -->
                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                    <h2 class="text-xl font-semibold mb-6 text-gray-800 dark:text-white">Board Members</h2>
                    
                    @if(count($members) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($members as $member)
                                <div class="flex flex-col items-center p-4 bg-gray-50 dark:bg-zinc-800 rounded-lg">
                                    <div class="w-32 h-32 mb-4 overflow-hidden rounded-full">
                                        <img src="data:image/jpeg;base64,{{ $member->photo }}" alt="{{ $member->member_name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $member->member_name }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $member->position }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center">No board members available.</p>
                    @endif
                </div>
            </div>
        @else
            <div
                class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-12 border border-gray-100 dark:border-zinc-700 text-center">
                <p class="text-gray-500 dark:text-gray-400 mb-6">No information available yet.</p>
            </div>
        @endif
    </div>
</x-layouts.app>
