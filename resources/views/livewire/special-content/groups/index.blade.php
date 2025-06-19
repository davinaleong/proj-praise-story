<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            Private Praise Stories
        </h1>

        <div class="flex items-center gap-3">
            @include('partials.dashboard-button')
            @include('partials.special-content-button')
            @include('partials.logout-button')
        </div>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($groups as $group)
            <a href="{{ route('special-content.groups.show', $group->uuid) }}"
               class="rounded-lg border border-black dark:border-white bg-black text-white dark:bg-white dark:text-black p-6 shadow-lg block transition hover:opacity-90">
                <h2 class="text-lg font-semibold mb-2">
                    {{ $group->title }}
                </h2>
                <p class="text-sm">
                    {{ Str::limit($group->description, 100) }}
                </p>
            </a>
        @empty
            <p class="text-center text-gray-600 dark:text-gray-400 col-span-full">
                No special content available at this time.
            </p>
        @endforelse
    </section>

    @include('partials.footer')
</div>
