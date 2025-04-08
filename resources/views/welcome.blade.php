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

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <x-layouts.app :title="__('Home')">
        <!-- Hero Section-->
        <div class="relative h-screen w-full">
            <!-- Top background blur -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem] animate-blob animation-delay-2000"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            <!-- Additional animated blobs -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%+11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-linear-to-tr from-[#36b1ff] to-[#4f46e5] opacity-30 sm:left-[calc(50%+20rem)] sm:w-[72.1875rem] animate-blob animation-delay-4000"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            <!-- Hero Text Content -->
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

        <!-- Announcements Carousel -->
        <div id="carousel" class="pt-5">
            <div class="text-center mb-8">
                <flux:heading size="xl" class="text-4xl md:text-5xl">
                    Latest News <h2 class="font-semibold block md:inline">最新消息</h2>
                </flux:heading>
                <div class="mt-2 text-sm md:text-base tracking-widest uppercase text-gray-600 dark:text-gray-400 flex flex-wrap justify-center gap-x-2">
                    <span>Get</span>
                    <span>the</span>
                    <span>latest</span>
                    <span>news</span>
                    <span>and Announcements</span>
                </div>
            </div>
            <div x-data="{
                // Sets the time between each slides in milliseconds
                autoplayIntervalTime: 4500,
                slides: [{
                        imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-1.webp',
                        imgAlt: 'Vibrant abstract painting with swirling blue and light pink hues on a canvas.',
                        title: 'Slide 1',
                        description: 'Samlple text Samlple text Samlple text Samlple text Samlple text Samlple text Samlple text',
                    },
                    {
                        imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-2.webp',
                        imgAlt: 'Vibrant abstract painting with swirling red, yellow, and pink hues on a canvas.',
                        title: 'Slide 2',
                        description: 'Samlple text Samlple text Samlple text Samlple text Samlple text Samlple text Samlple text',
                    },
                    {
                        imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-3.webp',
                        imgAlt: 'Vibrant abstract painting with swirling blue and purple hues on a canvas.',
                        title: 'Slide 3',
                        description: 'Samlple text Samlple text Samlple text Samlple text Samlple text Samlple text Samlple text',
                    },
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
            }" x-init="autoplay" class="relative w-full overflow-hidden">

                <!-- Slider -->
                <div class="relative min-h-[70svh] w-full">
                    <template x-for="(slide, index) in slides">
                        <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0"
                            x-transition.opacity.duration.1000ms>

                            <!-- Title and description -->
                            <div
                                class="rounded lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col items-center justify-end gap-2 bg-linear-to-t from-surface-dark/85 to-transparent px-16 py-12 text-center">
                                <h3 class="w-full lg:w-[80%] text-balance text-2xl lg:text-3xl font-bold text-on-surface-dark-strong"
                                    x-text="slide.title"
                                    x-bind:aria-describedby="'slide' + (index + 1) + 'Description'"></h3>
                                <p class="lg:w-1/2 w-full text-pretty text-sm text-on-surface-dark"
                                    x-text="slide.description" x-bind:id="'slide' + (index + 1) + 'Description'"></p>
                            </div>

                            <img class="rounded absolute w-full h-full inset-0 object-cover text-on-surface dark:text-on-surface-dark"
                                x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
                        </div>
                    </template>
                </div>

                <!-- Slider indicators -->
                <div class="absolute rounded-radius bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 px-1.5 py-1 md:px-2"
                    role="group" aria-label="slides">
                    <template x-for="(slide, index) in slides">
                        <button class="size-2 rounded-full transition"
                            x-on:click="(currentSlideIndex = index + 1), setAutoplayInterval(autoplayIntervalTime)"
                            x-bind:class="[currentSlideIndex === index + 1 ? 'bg-on-surface-dark' : 'bg-on-surface-dark/50']"
                            x-bind:aria-label="'slide ' + (index + 1)"></button>
                    </template>
                </div>
            </div>
        </div>

        <!-- Events Section -->
        <div class="mt-15">
            <div class="text-center mb-8">
                <flux:heading size="xl" class="text-4xl md:text-5xl">
                    Events <h2 class="font-semibold block md:inline">活动</h2>
                </flux:heading>
                <div class="mt-2 text-sm md:text-base tracking-widest uppercase text-gray-600 dark:text-gray-400 flex flex-wrap justify-center gap-x-2">
                    <span>Explore</span>
                    <span>what's</span>
                    <span>happening</span>
                    <span>in</span>
                    <span>KKHS</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                @foreach ($events as $event)
                    <a href="{{ route('events.show', $event->id) }}" class="block hover:no-underline h-full group">
                        <article
                            class="relative overflow-hidden rounded-lg shadow-sm transition-transform duration-300 hover:shadow-lg hover:scale-105 h-96">
                            <!-- Background Image -->
                            <img alt="{{ $event->title }}"
                                src="{{ $event->thumbnail ? 'data:image/jpeg;base64,' . base64_encode($event->thumbnail) : 'http://velocityacademy.org/wp-content/uploads/2016/03/placeholder.jpg' }}"
                                class="absolute inset-0 h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" />

                            <!-- Bottom Overlay with Gradient & Text -->
                            <div class="absolute bottom-0 left-0 right-0">
                                <div class="bg-gradient-to-t from-gray-900/50 to-gray-900/25 p-4 sm:p-6">
                                    <flux:badge color="{{ $tagColors[$event->tag] ?? 'zinc' }}"
                                        class="inline-block text-sm text-white">
                                        {{ $event->tag }}
                                    </flux:badge>

                                    <h3 class="mt-2 text-lg font-bold text-white">
                                        {{ $event->title }}
                                    </h3>

                                    <!-- Truncate the description to avoid pushing the badge upward -->
                                    <p class="mt-2 line-clamp-3 text-sm/relaxed text-white/95">
                                        {{ $event->description }}
                                    </p>
                                </div>
                            </div>
                        </article>
                    </a>
                @endforeach
            </div>
        </div>

    </x-layouts.app>
    </div>

    @fluxScripts
</body>

</html>
