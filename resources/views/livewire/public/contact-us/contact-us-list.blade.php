<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Contact Us</h2>
        <p class="mt-4 text-lg leading-8 text-gray-600 dark:text-gray-300">Get in touch with us</p>
    </div>

    @if ($contactUs)
        <div class="mt-12 grid grid-cols-1 gap-8 lg:grid-cols-2">
            <div
                class="space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-800">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Address</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $contactUs->address }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Email</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        <a href="mailto:{{ $contactUs->email }}"
                            class="text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                            {{ $contactUs->email }}
                        </a>
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Phone Numbers</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        <a href="tel:{{ $contactUs->phone_no1 }}"
                            class="block text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                            {{ $contactUs->phone_no1 }}
                        </a>
                        @if ($contactUs->phone_no2)
                            <a href="tel:{{ $contactUs->phone_no2 }}"
                                class="block text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                {{ $contactUs->phone_no2 }}
                            </a>
                        @endif
                    </p>
                </div>
            </div>

            <div
                class="h-96 bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-800">
                @if ($contactUs->map_url)
                    <iframe src="{{ $contactUs->map_url }}" class="w-full h-full rounded-xl" style="border:0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                @endif
            </div>
        </div>
    @else
        <div class="mt-12 text-center text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-zinc-800 p-8 rounded-lg">
            Contact information is not available at the moment.
        </div>
    @endif
</div>