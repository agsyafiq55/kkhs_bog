<x-layouts.app>
    <!-- Hero Banner -->
    <div
        class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 relative overflow-hidden mb-8">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://mrwallpaper.com/images/hd/chinese-lantern-photography-azuq3mbutdxhp3z7.jpg"
                alt="Chinese landscape" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-white/80 dark:bg-zinc-900/80"></div>
        </div>

        <div class="flex flex-col md:flex-row relative z-10">
            <div class="md:w-2/3 p-8 flex flex-col justify-center">
                <h1 class="text-7xl font-bold mb-2">About Us</h1>
                <h2 class="text-5xl font-semibold">关于我们</h2>
            </div>
            <div class="md:w-1/3 p-8 flex items-center">
                <p class="text-sm md:text-base text-justify">
                    Our diverse board that comprises of individuals from different background and industries is
                    committed towards maintaining and developing the school and adding value to the development and
                    well-being of the students.
                    <br><br>
                    我们多元化的董事会由来自不同背景和行业的组成，团结一致, 维持和发展学校, 提升学生的福利和全方位发展。
                </p>
            </div>
        </div>
    </div>

    {{-- About us section --}}
    <div class="container mx-auto max-full">
        @if ($aboutUs)
            <div class="space-y-8">
                <!-- Organization Photo -->
                <div
                    class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                    <div class="flex justify-center">
                        <div class="max-w-5xl w-full">
                            <div class="aspect-video bg-gray-100 dark:bg-zinc-800 rounded-lg overflow-hidden">
                                <img src="data:image/jpeg;base64,{{ $aboutUs->organization_photo }}"
                                    alt="Organization Photo" class="w-full h-full object-contain">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chairman Photo and Speech Combined -->
                <div
                    class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Chairman's Message</h2>
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="md:w-1/3 flex flex-col items-center">
                            <div class="w-64 h-64 mb-4 overflow-hidden rounded-lg shadow-md">
                                <img src="data:image/jpeg;base64,{{ $aboutUs->chairman_photo }}" alt="Chairman Photo"
                                    class="w-full h-full object-cover">
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

                <!-- Meet Our Team Banner -->
                <div
                    class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 relative overflow-hidden">
                    <!-- Background image with overlay -->
                    <div class="absolute inset-0 z-0">
                        <img src="https://images.pexels.com/photos/6775105/pexels-photo-6775105.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="Chinese landscape" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-white/80 dark:bg-zinc-900/80"></div>
                    </div>

                    <div class="flex flex-col md:flex-row relative z-10">
                        <div class="md:w-1/3 p-8 flex items-center">
                            <p class="text-sm md:text-base text-justify">
                                Our diverse board that comprises of individuals from different background and industries
                                is committed towards maintaining and developing the school and adding value to the
                                development and well-being of the students.
                                <br><br>
                                我们多元化的董事会由来自不同背景和行业的组成，团结一致, 维持和发展学校, 提升学生的福利和全方位发展。
                            </p>
                        </div>
                        <div class="md:w-2/3 p-8 flex flex-col justify-center items-end text-right">
                            <h1 class="text-7xl font-bold mb-2">Meet Our Team</h1>
                            <h2 class="text-5xl font-semibold">关于我们</h2>
                        </div>
                    </div>
                </div>

                <!-- Board Members Section -->
                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                    @if (count($members) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach ($members as $member)
                                <div class="group relative bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-100 dark:border-zinc-700">
                                    <div class="p-6">
                                        <!-- Member Photo - Centered and Rounded -->
                                        <div class="flex justify-center mb-4">
                                            <div class="relative w-[150px] h-[150px] rounded-full overflow-hidden bg-gray-100 dark:bg-zinc-800 border-4 border-white dark:border-zinc-700 shadow-md">
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
                                            <div class="inline-block bg-red-700 text-white text-xs font-medium px-2.5 py-1 rounded-full shadow">
                                                {{ $member->position }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Hover overlay for better UX -->
                                    <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity pointer-events-none"></div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 dark:bg-zinc-900 rounded-lg">
                            <p class="text-gray-500 dark:text-gray-400">No board members available.</p>
                        </div>
                    @endif
                </div>

                <!-- Timeline Section -->
                <div
                    class="bg-white dark:bg-zinc-900 rounded-t-xl shadow-sm border border-gray-100 dark:border-zinc-700 border-b-0 relative overflow-hidden">
                    <!-- Background image with overlay -->
                    <div class="absolute inset-0 z-0">
                        <img src="https://cdn.pixabay.com/photo/2017/07/02/09/03/books-2463779_1280.jpg"
                            alt="Chinese landscape" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-white/80 dark:bg-zinc-900/80"></div>
                    </div>

                    <div class="flex flex-col md:flex-row relative z-10">
                        <div class="md:w-2/3 p-8 flex flex-col justify-center">
                            <h1 class="text-8xl font-bold mb-2">Our Journey</h1>
                            <h2 class="text-6xl font-semibold">照片库</h2>
                        </div>
                        <div class="md:w-1/3 p-8 flex items-center">
                            <p class="text-sm md:text-base text-justify">
                                Explore the mesmerizing sceneries and various facilities offered in Kota Kinabalu High
                                School.
                                <br><br>
                                探索亚庇高中迷人的风景和各种设施。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-zinc-900 rounded-b-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700 border-t-0">
                    <livewire:timeline />
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
