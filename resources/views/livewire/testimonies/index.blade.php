<x-layouts.app title="Praise Stories">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Praise Stories</h1>
            @include('partials.login-button')
        </header>

        <hr class="mb-8 border-gray-300 dark:border-gray-700">

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonies as $testimony)
                @if ($loop->index === 3)
                    <!-- Premium CTA Card -->
                    <div class="rounded-lg border border-black dark:border-white bg-black text-white dark:bg-white dark:text-black p-6 shadow-lg text-center col-span-1 sm:col-span-2 lg:col-span-3">
                        <h2 class="text-xl font-bold mb-2">
                            Go Premium. Share Privately.
                        </h2>
                        <p class="text-sm mb-4">
                            Everyone can share public praise stories for free. <br class="hidden sm:inline" />
                            Upgrade to premium to keep selected testimonies private — just for you or your inner circle.
                        </p>

                        <a href="{{ route('premium.checkout') }}"
                        class="inline-block bg-white text-black dark:bg-black dark:text-white font-semibold text-sm px-5 py-2 rounded-md transition hover:opacity-90">
                            Learn More & Upgrade
                        </a>
                    </div>
                @endif

                <!-- Testimony Card -->
                <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm bg-white dark:bg-zinc-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $testimony->title }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 italic">
                        <em>Written by {{ optional($testimony->user)->name ?? 'Anonymous' }} on {{ $testimony->getHumanPublishedAt() }}</em>
                    </p>
                    <a href="{{ route('testimonies.public', $testimony->uuid) }}"
                       class="inline-block mt-4 text-sm font-bold text-black dark:text-white hover:underline">
                        Read more &hellip;
                    </a>
                </div>
            @endforeach
        </section>

        @include('partials.footer')
    </div>
</x-layouts.app>
