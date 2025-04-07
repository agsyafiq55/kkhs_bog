@auth
{{-- For authenticated users (admin), use sidebar layout --}}
<x-layouts.app.sidebar :title="$title ?? null">
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow">
            <flux:main>
                {{ $slot }}
            </flux:main>
        </div>
    </div>
</x-layouts.app.sidebar>
@else
{{-- For guests, use header layout --}}
<x-layouts.app.header :title="$title ?? null">
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow">
            <flux:main>
                {{ $slot }}
            </flux:main>
        </div>
        
        <div class="mt-auto">
            <x-layouts.app.footer />
        </div>
    </div>
</x-layouts.app.header>
@endauth