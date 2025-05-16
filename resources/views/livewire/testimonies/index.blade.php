<x-layouts.app title="Praise Stories">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Praise Stories</h1>
        <hr class="mb-8 border-gray-300 dark:border-gray-700">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonies as $testimony)
                <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm bg-white dark:bg-zinc-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $testimony->title }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 italic">
                        <em>Written by {{ $testimony->user->name }} on {{ $testimony->getHumanPublishedAt() }}</em>
                    </p>
                    <a href="{{ route('testimonies.public', $testimony->uuid) }}"
                       class="inline-block mt-4 text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-medium">
                        Read more &hellip;
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
