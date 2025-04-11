@php
    // Map event tags to badge colors
    $tagColors = [
        'Sports' => 'blue',
        'Education' => 'emerald',
        'Technology' => 'cyan',
        'Culture' => 'amber',
        'Entertainment' => 'fuchsia',
        'Health' => 'green',
        'Business' => 'rose',
        'Environment' => 'lime',
        'Art' => 'purple',
        'Science' => 'indigo',
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KKHSbog</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<!-- Main content container with all other sections -->
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <x-layouts.app :title="__('Home')">
        {{-- Hero Section --}}
        <div id="hero-section" class="relative h-screen w-full">
            <!-- Top background blur -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem] animate-blob animation-delay-2000"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            <!-- Background animated blobs -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%+11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-linear-to-tr from-[#36b1ff] to-[#4f46e5] opacity-30 sm:left-[calc(50%+20rem)] sm:w-[72.1875rem] animate-blob animation-delay-4000"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            <!-- Hero Text -->
            <div class="flex h-full items-center justify-center">
                <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)" class="text-center">
                    <h1 class="text-5xl font-semibold tracking-tight text-white sm:text-7xl transition-all duration-1000 ease-out hover:text-red-500 hover:scale-105 cursor-default"
                        x-bind:class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                        KKHS Board of Governors
                    </h1>
                    <h1 class="text-3xl font-semibold tracking-tight text-white sm:text-7xl transition-all duration-1000 ease-out hover:text-red-500 hover:scale-105 cursor-default"
                        x-bind:class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                        亚庇中学董事会
                    </h1>
                    <p class="mt-8 text-lg font-medium text-gray-300 sm:text-xl transition-all duration-1000 delay-300 ease-out hover:text-white hover:translate-y-[-2px] cursor-default"
                        x-bind:class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                        Preserving a Quality Education System to Develop Individual Potential to Fulfill National
                        Aspirations.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6 transition-all duration-1000 delay-500 ease-out"
                        x-bind:class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                        <a href="#carousel"
                            class="rounded-md bg-red-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400"
                            onclick="event.preventDefault(); document.getElementById('carousel').scrollIntoView({behavior: 'smooth'});">
                            Explore KKHS!
                        </a>
                    </div>
                </div>
            </div>
            <!-- Bottom Background Blur -->
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-linear-to-tr from-[#c71c28] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>

        <!-- 1. Announcements Section -->
        <div class="max-w-6xl align mx-auto">
            <div id="carousel" class="pt-5">
                @php
                    // Get the latest 3 announcements ordered by published_at date
                    $latestAnnouncements = App\Models\Announcement::orderBy('published_at', 'desc')->take(3)->get();
                @endphp
                <div x-data="{
                    // Sets the time between each slides in milliseconds
                    autoplayIntervalTime: 4500,
                    slides: [
                        @foreach ($latestAnnouncements as $announcement)
                    {
                        imgSrc: '{{ $announcement->image ? 'data:image/jpeg;base64,' . $announcement->image : 'http://velocityacademy.org/wp-content/uploads/2016/03/placeholder.jpg' }}',
                        imgAlt: '{{ $announcement->title }}',
                        title: '{{ $announcement->title }}',
                        description: '{{ Str::limit(strip_tags($announcement->content), 150) }}',
                        link: '{{ route('announcements.show', $announcement->id) }}'
                    }, @endforeach
                    ],
                    currentSlideIndex: 1,
                    isPaused: false,
                    autoplayInterval: null,
                    previous() {
                        if (this.currentSlideIndex > 1) {
                            this.currentSlideIndex = this.currentSlideIndex - 1
                        } else {
                            // If it's the first slide, go to the last slide           
                            this.currentSlideIndex = this.slides.length
                        }
                    },
                    next() {
                        if (this.currentSlideIndex < this.slides.length) {
                            this.currentSlideIndex = this.currentSlideIndex + 1
                        } else {
                            // If it's the last slide, go to the first slide    
                            this.currentSlideIndex = 1
                        }
                    },
                    autoplay() {
                        this.autoplayInterval = setInterval(() => {
                            if (!this.isPaused) {
                                this.next()
                            }
                        }, this.autoplayIntervalTime)
                    },
                    // Updates interval time   
                    setAutoplayInterval(newIntervalTime) {
                        clearInterval(this.autoplayInterval)
                        this.autoplayIntervalTime = newIntervalTime
                        this.autoplay()
                    },
                }" x-init="autoplay" class="relative w-full overflow-hidden rounded-xl shadow-lg">

                    <!-- Slider -->
                    <div class="relative min-h-[500px] w-full bg-zinc-900">
                        <template x-for="(slide, index) in slides">
                            <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0"
                                x-transition.opacity.duration.1000ms>

                                <!-- Image with overlay gradient -->
                                <div class="absolute inset-0 bg-gradient-to-r from-zinc-900/90 via-zinc-900/60 to-transparent z-10"></div>
                                <img class="absolute w-full h-full inset-0 object-cover"
                                    x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />

                                <!-- Content positioned on left side -->
                                <div class="relative z-20 flex h-full">
                                    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                                        <div class="mb-2">
                                            <span class="bg-red-500 text-white text-xs font-medium px-2.5 py-1 rounded">ANNOUNCEMENT</span>
                                        </div>
                                        <h3 class="text-balance text-3xl md:text-6xl font-bold text-white mb-4"
                                            x-text="slide.title"></h3>
                                        <p class="text-pretty text-sm md:text-base text-gray-200 mb-6"
                                            x-text="slide.description"></p>
                                        <a x-bind:href="slide.link" 
                                           class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-100 text-gray-800 text-sm font-medium rounded-md transition-colors w-fit">
                                            Read More
                                            <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Slider indicators at bottom -->
                    <div class="absolute bottom-4 left-1/2 z-20 flex -translate-x-1/2 gap-2"
                        role="group" aria-label="slides">
                        <template x-for="(slide, index) in slides">
                            <button class="w-2 h-2 rounded-full transition"
                                x-on:click="(currentSlideIndex = index + 1), setAutoplayInterval(autoplayIntervalTime)"
                                x-bind:class="[currentSlideIndex === index + 1 ? 'bg-white' : 'bg-white/50']"
                                x-bind:aria-label="'slide ' + (index + 1)"></button>
                        </template>
                    </div>
                </div>
            </div>

            <!-- 2. Events Section -->
            <div class="mt-15">
                <div class="text-center mb-8">
                    <flux:heading size="xl" class="text-4xl md:text-5xl">
                        Events <h2 class="font-semibold block md:inline">活动</h2>
                    </flux:heading>
                    <div
                        class="mt-2 text-sm md:text-base tracking-widest uppercase text-gray-600 dark:text-gray-400 flex flex-wrap justify-center gap-x-2">
                        <span>Explore</span>
                        <span>what's</span>
                        <span>happening</span>
                        <span>in</span>
                        <span>KKHS</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                    @foreach ($events as $event)
                        <a href="{{ route('events.show', $event->id) }}" class="block hover:no-underline aspect-square group">
                            <article
                                class="relative overflow-hidden rounded-lg shadow-sm transition-transform duration-300 hover:shadow-lg hover:scale-105 pb-[110%]">
                                <!-- Background Image -->
                                <img alt="{{ $event->title }}"
                                    src="{{ $event->thumbnail ? 'data:image/jpeg;base64,' . $event->thumbnail : 'http://velocityacademy.org/wp-content/uploads/2016/03/placeholder.jpg' }}"
                                    class="absolute inset-0 h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" />

                                <!-- Bottom Overlay with Gradient & Text -->
                                <div class="absolute inset-0 flex flex-col justify-end">
                                    <div class="bg-gradient-to-t from-black via-black/50 to-transparent p-4 sm:p-6">
                                        <flux:badge color="{{ $tagColors[$event->tag] ?? 'zinc' }}"
                                            class="inline-block text-sm text-white">
                                            {{ $event->tag }}
                                        </flux:badge>

                                        <h3 class="text-lg font-bold text-white line-clamp-2">
                                            {{ $event->title }}
                                        </h3>
                                    </div>
                                </div>
                            </article>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Achievements Section -->
            <div
                class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 relative overflow-hidden mt-12">
                <!-- Background banner with overlay -->
                <div class="relative overflow-hidden mb-8">
                    <div class="absolute inset-0 z-0">
                        <img src="https://images.pexels.com/photos/1438072/pexels-photo-1438072.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="Trophy and achievements" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-white/80 dark:bg-zinc-900/80"></div>
                    </div>

                    <div class="flex flex-col md:flex-row relative z-10">
                        <div class="md:w-2/3 p-8 flex flex-col justify-center">
                            <h1 class="text-7xl font-bold mb-2">Our Achievements</h1>
                            <h2 class="text-5xl font-semibold">我们的成就</h2>
                        </div>
                        <div class="md:w-1/3 p-8 flex items-center">
                            <p class="text-sm md:text-base text-justify">
                                Explore our academic and co-curricular achievements that showcase the excellence and
                                dedication of our students and staff.
                                <br><br>
                                探索我们的学术和课外成就，展示我们学生和教职员工的卓越表现和奉献精神。
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Achievements Component -->
                <div class="p-6">
                    <livewire:achievements.achievements-display />
                </div>
            </div>
        </div>
    </x-layouts.app>
    </div>

    @fluxScripts

</body>

</html>
