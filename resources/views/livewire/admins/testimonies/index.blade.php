<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">All Testimonies</h1>
        <input type="text" wire:model.debounce.300ms="search"
               placeholder="Search..." class="rounded border px-4 py-2 text-sm" />
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <div class="overflow-x-auto rounded-t-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-900">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700 text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-zinc-800 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                <tr>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Author</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Published At</th>
                    <th class="px-6 py-4 text-right flex gap-2">&nbsp;</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($testimonies as $testimony)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $testimony->title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $testimony->user->name ?? '—' }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ $testimony->status }}
                        </td>
                        <td class="px-6 py-4">
                            {{ optional($testimony->published_at)->format('Y-m-d') ?? '—' }}
                        </td>
                        <td class="px-6 py-4 flex justify-items-end gap-2">
                            <a href="{{ route('admins.testimonies.show', $testimony->uuid) }}"
                               class="inline-block text-gray-500 hover:text-black dark:hover:text-white" title="View Testimony">
                                @include('flux.icon.eye')
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No testimonies found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $testimonies->links() }}
    </div>
</div>
