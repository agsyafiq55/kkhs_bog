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
    <title>KKHSedu</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <x-layouts.app :title="__('Home')">

        <!-- Main Content -->
        <div>
            <div x-data="{            
        // Sets the time between each slides in milliseconds
        autoplayIntervalTime: 4500,
        slides: [                
            {
                imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-1.webp',
                imgAlt: 'Vibrant abstract painting with swirling blue and light pink hues on a canvas.',  
                title: 'Slide 1',
                description: 'The architects of the digital world, constantly battling against their mortal enemy – browser compatibility.',           
            },                
            {                    
                imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-2.webp',                    
                imgAlt: 'Vibrant abstract painting with swirling red, yellow, and pink hues on a canvas.',  
                title: 'Slide 2',
                description: 'Because not all superheroes wear capes, some wear headphones and stare at terminal screens',            
            },                
            {                    
                imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-3.webp',                    
                imgAlt: 'Vibrant abstract painting with swirling blue and purple hues on a canvas.',    
                title: 'Slide 3',
                description: 'Where &quot;burnout&quot; is just a fancy term for &quot;Tuesday&quot;.',       
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
                if (! this.isPaused) {
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
                <div class="relative min-h-[50svh] w-full">
                    <template x-for="(slide, index) in slides">
                        <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.1000ms>

                            <!-- Title and description -->
                            <div class="rounded lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col items-center justify-end gap-2 bg-linear-to-t from-surface-dark/85 to-transparent px-16 py-12 text-center">
                                <h3 class="w-full lg:w-[80%] text-balance text-2xl lg:text-3xl font-bold text-on-surface-dark-strong" x-text="slide.title" x-bind:aria-describedby="'slide' + (index + 1) + 'Description'"></h3>
                                <p class="lg:w-1/2 w-full text-pretty text-sm text-on-surface-dark" x-text="slide.description" x-bind:id="'slide' + (index + 1) + 'Description'"></p>
                            </div>

                            <img class="rounded absolute w-full h-full inset-0 object-cover text-on-surface dark:text-on-surface-dark" x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
                        </div>
                    </template>
                </div>

                <!-- Slider indicators -->
                <div class="absolute rounded-radius bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 px-1.5 py-1 md:px-2" role="group" aria-label="slides">
                    <template x-for="(slide, index) in slides">
                        <button class="size-2 rounded-full transition" x-on:click="(currentSlideIndex = index + 1), setAutoplayInterval(autoplayIntervalTime)" x-bind:class="[currentSlideIndex === index + 1 ? 'bg-on-surface-dark' : 'bg-on-surface-dark/50']" x-bind:aria-label="'slide ' + (index + 1)"></button>
                    </template>
                </div>
            </div>
        </div>

        <!--Events sections-->
        <div class="mt-6">
            <flux:heading size="xl">Events</flux:heading>
            <flux:heading size="lg">Explore what's happening in KKHS.</flux:heading>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                @foreach($events as $event)
                <article class="group flex rounded-radius max-w-sm flex-col overflow-hidden border border-outline bg-surface-alt dark:border-outline-dark dark:bg-surface-dark-alt">
                    <div class="h-44 md:h-64 overflow-hidden">
                        @if($event->thumbnail)
                        <img src="data:image/jpeg;base64,{{ base64_encode($event->thumbnail) }}"
                            class="object-cover w-full h-full transition duration-700 ease-out group-hover:scale-105"
                            alt="{{ $event->title }}" />
                        @else
                        <img src="http://velocityacademy.org/wp-content/uploads/2016/03/placeholder.jpg"
                            class="object-cover w-full h-full transition duration-700 ease-out group-hover:scale-105"
                            alt="{{ $event->title }}" />
                        @endif
                    </div>
                    <div class="flex flex-col gap-4 p-6">
                        <div class="inline-block items-end">
                            <flux:badge color="{{ $tagColors[$event->tag] ?? 'zinc' }}" class="inline">{{ $event->tag }}</flux:badge>
                        </div>
                        <h3 class="text-xl font-bold">{{ $event->title }}</h3>
                        <p class="text-sm">{{ $event->description }}</p>
                    </div>
                </article>
                @endforeach
            </div>
        </div>

        <!-- Events Section -->
        <div class="mt-6">
            <flux:heading size="xl">Events</flux:heading>
            <flux:heading size="lg">Explore what's happening in KKHS.</flux:heading>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                @foreach($events as $event)
                <article class="relative overflow-hidden rounded-lg shadow-sm transition hover:shadow-lg">
                    <img
                        alt="{{ $event->title }}"
                        src="{{ $event->thumbnail ? 'data:image/jpeg;base64,' . base64_encode($event->thumbnail) : 'http://velocityacademy.org/wp-content/uploads/2016/03/placeholder.jpg' }}"
                        class="absolute inset-0 h-full w-full object-cover" />

                    <div class="h-full relative bg-gradient-to-t from-gray-900/50 to-gray-900/25 pt-32 sm:pt-48 lg:pt-64">
                        <div class="p-4 sm:p-6">
                            <flux:badge color="{{ $tagColors[$event->tag] ?? 'zinc' }}" class="mt-4 inline-block">
                                {{ $event->tag }}
                            </flux:badge>

                            <a href="#">
                                <h3 class="mt-0.5 text-lg font-bold text-white">{{ $event->title }}</h3>
                            </a>

                            <p class="mt-2 line-clamp-3 text-sm/relaxed text-white/95">
                                {{ $event->description }}
                            </p>

                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>


    </x-layouts.app>
    </div>

    @fluxScripts
</body>

</html>