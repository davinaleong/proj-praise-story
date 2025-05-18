<div wire:init="loadTestimonies" class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    @if ($readyToLoad)
        {{-- Summary Cards --}}
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="flex flex-col items-center justify-center aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 p-4">
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Public Testimonies</h2>
                <p class="text-3xl font-bold text-black dark:text-white mt-2">{{ $counts['public'] }}</p>
            </div>
            <div class="flex flex-col items-center justify-center aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 p-4">
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Private Testimonies</h2>
                <p class="text-3xl font-bold text-black dark:text-white mt-2">{{ $counts['private'] }}</p>
            </div>
            <div class="flex flex-col items-center justify-center aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 p-4">
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Published</h2>
                <p class="text-3xl font-bold text-black dark:text-white mt-2">{{ $counts['published'] }}</p>
            </div>
        </div>

        {{-- Testimony Table --}}
        <div class="relative h-full flex-1 overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900">
            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-100 dark:bg-zinc-800 text-xs uppercase font-medium">
                    <tr>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Published At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($testimonies as $testimony)
                        <tr class="border-t border-gray-200 dark:border-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-800">
                            <td class="px-6 py-4 font-medium">{{ $testimony->title }}</td>
                            <td class="px-6 py-4 capitalize">{{ $testimony->status }}</td>
                            <td class="px-6 py-4">
                                {{ optional($testimony->published_at)->format('Y-m-d') ?? '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No testimonies written yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-12 text-gray-500 dark:text-gray-400">
            Loading testimonies...
        </div>
    @endif
</div>
