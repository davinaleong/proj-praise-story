<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            Special Content Items
        </h1>
        <a href="{{ route('admins.special-contents.items.create') }}"
            class="inline-flex items-center gap-2 bg-black text-white dark:bg-white dark:text-black font-semibold text-sm px-5 py-2 rounded-md transition hover:opacity-90">
            @include('flux.icon.plus') Create Special Content Item
        </a>
    </header>

    <hr class="mb-6 border-gray-300 dark:border-gray-700">

    <div class="overflow-x-auto rounded-t-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-900">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700 text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-zinc-800 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                <tr>
                    <th class="p-2">Group</th>
                    <th class="p-2">Title</th>
                    <th class="p-2">Slug</th>
                    <th class="p-2">Type</th>
                    <th class="p-2">Created</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($items as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800">
                        <td class="p-2 font-medium">{{ $item->specialContentGroup ? $item->specialContentGroup->title : '-' }}</td>
                        <td class="p-2 font-medium">{{ $item->title }}</td>
                        <td class="p-2 text-gray-500">{{ $item->slug }}</td>
                        <td class="p-2">{{ $item->type }}</td>
                        <td class="p-2 text-gray-500">{{ $item->created_at->format('d-m-Y') }}</td>
                        <td class="p-2 space-x-2">
                            <a href="{{ route('admins.special-contents.items.show', ['uuid' => $item->uuid]) }}"
                               class="inline-block text-gray-500 hover:text-black dark:hover:text-white" title="View Group">
                                @include('flux.icon.eye')
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-500">
                            No special content items found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">
                        {{ $items->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
