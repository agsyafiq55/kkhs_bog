<div>
    <!-- Tabs -->
    <div class="flex border-b border-gray-200 dark:border-zinc-700 mb-6">
        <button wire:click="setTab('academic')" type="button"
            class="cursor-pointer py-4 px-6 text-center border-b-2 font-medium text-sm {{ $activeTab === 'academic' ? 'border-indigo-500 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600' }}">
            Academic Achievements
        </button>
        <button wire:click="setTab('cocurricular')" type="button"
            class="cursor-pointer py-4 px-6 text-center border-b-2 font-medium text-sm {{ $activeTab === 'cocurricular' ? 'border-amber-500 text-amber-600 dark:border-amber-400 dark:text-amber-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600' }}">
            Co-Curricular Achievements
        </button>
    </div>

    <!-- Year Filter -->
    <div class="mb-6">
        <div class="flex flex-wrap gap-2">
            @if ($activeTab === 'academic')
                @foreach ($academicYears as $year)
                    <button wire:click="setYear({{ $year }})" type="button"
                        class="cursor-pointer px-4 py-2 text-sm font-medium rounded-full {{ $selectedYear == $year ? 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-zinc-800 dark:text-gray-200 dark:hover:bg-zinc-700' }}">
                        {{ $year }}
                    </button>
                @endforeach
            @else
                @foreach ($cocurricularYears as $year)
                    <button wire:click="setYear({{ $year }})" type="button"
                        class="px-4 py-2 text-sm font-medium rounded-full {{ $selectedYear == $year ? 'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-zinc-800 dark:text-gray-200 dark:hover:bg-zinc-700' }}">
                        {{ $year }}
                    </button>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Category Filter (only for co-curricular) -->
    @if ($activeTab === 'cocurricular' && $categories->count() > 0)
        <div class="mb-6">
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter by Category:</h3>
            <div class="flex flex-wrap gap-2">
                @foreach ($categories as $category)
                    <button wire:click="setCategory('{{ $category }}')" type="button"
                        class="px-4 py-2 text-sm font-medium rounded-full {{ $selectedCategory == $category ? 'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-zinc-800 dark:text-gray-200 dark:hover:bg-zinc-700' }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Academic Achievements Display -->
    @if ($activeTab === 'academic')
        <div class="space-y-6">
            @forelse ($academicAchievements as $achievement)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $achievement->exam_type }} {{ $achievement->year }}</h3>
                                <div class="mt-2 flex items-center">
                                    <span class="text-sm text-gray-500 dark:text-gray-400 mr-4">GPS: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ number_format($achievement->gps, 2) }}</span></span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Certificate: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ number_format($achievement->certificate_percentage, 2) }}%</span></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Grade Distribution:</h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                                @foreach ($achievement->grades as $grade)
                                    <div class="bg-indigo-50 dark:bg-indigo-900/30 rounded-lg p-3 text-center">
                                        <span class="block text-lg font-bold text-indigo-600 dark:text-indigo-400">{{ $grade->grade }}</span>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $grade->student_count }} students</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <p class="text-lg font-medium text-gray-700 dark:text-gray-300">No academic achievements found for {{ $selectedYear }}</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try selecting a different year.</p>
                </div>
            @endforelse
        </div>
    @endif

    <!-- Co-curricular Achievements Display -->
    @if ($activeTab === 'cocurricular')
        <div class="space-y-6">
            @forelse ($cocurricularAchievements as $achievement)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between">
                            <div class="mb-4 md:mb-0">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $achievement->event_title }}</h3>
                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $achievement->category }}
                                    </span>
                                    
                                    @php
                                        $placementColors = [
                                            'Gold' => 'yellow',
                                            'Silver' => 'gray',
                                            'Bronze' => 'amber',
                                            'Scholarship' => 'emerald',
                                            'First Place' => 'yellow',
                                            'Second Place' => 'gray',
                                            'Third Place' => 'amber',
                                            'Honorable Mention' => 'purple',
                                        ];
                                        $color = $placementColors[$achievement->placement_type] ?? 'indigo';
                                    @endphp
                                    
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-800 dark:bg-{{ $color }}-900 dark:text-{{ $color }}-200">
                                        {{ $achievement->placement_type }}
                                    </span>
                                    
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $achievement->event_date->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="bg-amber-50 dark:bg-amber-900/30 rounded-lg px-4 py-2 text-center">
                                    <span class="block text-lg font-bold text-amber-600 dark:text-amber-400">{{ $achievement->student_count }}</span>
                                    <span class="text-xs text-gray-600 dark:text-gray-400">Students</span>
                                </div>
                            </div>
                        </div>

                        @if ($achievement->description)
                            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400 border-t border-gray-100 dark:border-zinc-700 pt-4">
                                {{ $achievement->description }}
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <p class="text-lg font-medium text-gray-700 dark:text-gray-300">No co-curricular achievements found</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        @if ($selectedCategory)
                            No achievements found for {{ $selectedCategory }} in {{ $selectedYear }}. Try a different category or year.
                        @else
                            No achievements found for {{ $selectedYear }}. Try selecting a different year.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>
    @endif
</div>