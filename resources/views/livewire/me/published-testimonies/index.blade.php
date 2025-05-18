<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">My Published Testimonies</h1>
        @include('partials.create-button')
    </div>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($testimonies as $testimony)
            <!-- Testimony Card -->
            <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm bg-white dark:bg-zinc-800">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $testimony->title }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 italic">
                    <em>Written by {{ optional($testimony->user)->name ?? 'Anonymous' }} on {{ $testimony->getHumanPublishedAt() }}</em>
                </p>
                <a href="{{ route('me.published.show', $testimony->uuid) }}"
                   class="inline-block mt-4 text-sm font-bold text-black dark:text-white hover:underline">
                    Read more &hellip;
                </a>
            </div>
        @endforeach
    </div>
</div>
