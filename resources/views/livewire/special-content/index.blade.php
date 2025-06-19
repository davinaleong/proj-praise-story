<x-layouts.app title="Special Content Groups">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Special Content Groups
            </h1>

            @include('partials.private-nav')
        </header>

        <hr class="mb-8 border-gray-300 dark:border-gray-700">

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($groups as $group)
                <div class="rounded-lg border p-6 shadow-sm border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white">
                    <h2 class="text-lg font-semibold">
                        {{ $group->title }}
                    </h2>
                    <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">
                        {{ Str::limit($group->description, 100) }}
                    </p>
                    <a href="{{ route('special-content.show', ['uuid' => $group->uuid]) }}"
                       class="inline-block mt-4 text-sm font-bold underline">
                        View content &hellip;
                    </a>
                </div>
            @empty
                <p class="text-center text-gray-600 dark:text-gray-400 col-span-full">
                    No special content groups found.
                </p>
            @endforelse
        </section>

        @include('partials.footer')
    </div>
</x-layouts.app>
