<x-layouts.app title="Premium Praise Stories">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Private Praise Stories
            </h1>

            @include('partials.private-nav')
        </header>

        <hr class="mb-8 border-gray-300 dark:border-gray-700">

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($testimonies as $testimony)
                @php
                    $isPrivate = $testimony->status === \App\Helpers\Status::STATUS_TESTIMONY_PRIVATE;
                @endphp

                <div class="
                    rounded-lg border p-6 shadow-sm
                    {{ $isPrivate
                        ? 'border-black dark:border-white bg-black text-white dark:bg-white dark:text-black'
                        : 'border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white'
                    }}
                ">
                    @include('partials.likes-bar')

                    <h2 class="text-lg font-semibold">
                        {{ $testimony->title }}
                    </h2>
                    <p class="text-sm mt-2 italic">
                        <em>Written on {{ $testimony->getHumanPublishedAt() }}</em>
                    </p>
                    <a href="{{ route('private.testimonies.show', $testimony->uuid) }}"
                       class="inline-block mt-4 text-sm font-bold underline">
                        Read more &hellip;
                    </a>
                </div>
            @empty
                <p class="text-center text-gray-600 dark:text-gray-400 col-span-full">
                    No premium testimonies found.
                </p>
            @endforelse
        </section>

        @include('partials.footer')
    </div>
</x-layouts.app>
