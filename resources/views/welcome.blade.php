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
    <div class="p-4">
            <div x-data="{            
                slides: [                
                    {
                        imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-1.webp',
                        imgAlt: 'Vibrant abstract painting with swirling blue and light pink hues on a canvas.',                
                    },                
                    {                    
                        imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-2.webp',                    
                        imgAlt: 'Vibrant abstract painting with swirling red, yellow, and pink hues on a canvas.',                
                    },                
                    {                    
                        imgSrc: 'https://penguinui.s3.amazonaws.com/component-assets/carousel/default-slide-3.webp',                    
                        imgAlt: 'Vibrant abstract painting with swirling blue and purple hues on a canvas.',                
                    },            
                ],            
                currentSlideIndex: 1,
                touchStartX: null,
                touchEndX: null,
                swipeThreshold: 50,
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
                handleTouchStart(event) {
                    this.touchStartX = event.touches[0].clientX
                },
                handleTouchMove(event) {
                    this.touchEndX = event.touches[0].clientX
                },
                handleTouchEnd() {
                    if(this.touchEndX){
                        if (this.touchStartX - this.touchEndX > this.swipeThreshold) {
                            this.next()
                        }
                        if (this.touchStartX - this.touchEndX < -this.swipeThreshold) {
                            this.previous()
                        }
                        this.touchStartX = null
                        this.touchEndX = null
                    }
                },     
            }" class="relative w-full max-w-full overflow-hidden">

                <!-- previous button -->
                <button type="button" class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-surface/40 p-2 text-on-surface transition hover:bg-surface/60 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-on-surface-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark" aria-label="previous slide" x-on:click="previous()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <!-- next button -->
                <button type="button" class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-surface/40 p-2 text-on-surface transition hover:bg-surface/60 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-on-surface-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark" aria-label="next slide" x-on:click="next()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            
                <!-- slides -->
                <!-- Change min-h-[50svh] to your preferred height size -->
                <div class="relative min-h-[50svh] w-full" x-on:touchstart="handleTouchStart($event)" x-on:touchmove="handleTouchMove($event)" x-on:touchend="handleTouchEnd()">
                    <template x-for="(slide, index) in slides">
                        <div x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.700ms>
                            <img class="absolute w-full h-full inset-0 object-cover text-on-surface dark:text-on-surface-dark" x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
                        </div>
                    </template>
                </div>
                
                <!-- indicators -->
                <div class="absolute rounded-radius bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 bg-surface/75 px-1.5 py-1 md:px-2 dark:bg-surface-dark/75" role="group" aria-label="slides" >
                    <template x-for="(slide, index) in slides">
                        <button class="size-2 rounded-full transition bg-on-surface dark:bg-on-surface-dark" x-on:click="currentSlideIndex = index + 1" x-bind:class="[currentSlideIndex === index + 1 ? 'bg-on-surface dark:bg-on-surface-dark' : 'bg-on-surface/50 dark:bg-on-surface-dark/50']" x-bind:aria-label="'slide ' + (index + 1)"></button>
                    </template>
                </div>
            </div>

            <!--Events Sections-->
            <div class="grid-rows-4">
                <flux:heading class="text-4xl text-center p-6" size="xl">Events 活动</flux:heading>
                <article class="group flex rounded-radius max-w-sm flex-col overflow-hidden border border-outline bg-surface-alt text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark">
                    <div class="h-44 md:h-64 overflow-hidden"> 
                        <img src="http://velocityacademy.org/wp-content/uploads/2016/03/placeholder.jpg" class="object-cover transition duration-700 ease-out group-hover:scale-105" alt="a penguin robot talking with a human" />
                    </div>
                    <div class="flex flex-col gap-4 p-6">
                        <span class="text-sm font-medium">Features</span>
                        <h3 class="text-balance text-xl lg:text-2xl font-bold text-on-surface-strong dark:text-on-surface-dark-strong" aria-describedby="featureDescription">Penguai can teach you Javascript</h3>
                        <p id="featureDescription" class="text-pretty text-sm">
                            Learning JavaScript doesn't need to be difficult. Our penguin AI
                            robot can learn how much you know and will go at your speed.
                            Although Penguai is small, he's got a mighty big CPU.
                        </p>
                    </div>
                </article>
            </div>

        </x-layouts.app>
    </div>

    @fluxScripts
</body>
</html>
