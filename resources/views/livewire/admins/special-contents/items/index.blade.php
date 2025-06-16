<div class="space-y-6">

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

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 dark:border-gray-700 text-sm">
            <thead class="bg-gray-100 dark:bg-zinc-800 text-left">
                <tr>
                    <th class="p-2">Title</th>
                    <th class="p-2">Slug</th>
                    <th class="p-2">Type</th>
                    <th class="p-2">Status</th>
                    <th class="p-2 text-center">Sort</th>
                    <th class="p-2">Created</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr class="border-t border-gray-200 dark:border-zinc-700">
                        <td class="p-2 font-medium">{{ $item->title }}</td>
                        <td class="p-2 text-gray-500">{{ $item->slug }}</td>
                        <td class="p-2">{{ ucfirst($item->type) }}</td>
                        <td class="p-2">{{ ucfirst($item->status) }}</td>
                        <td class="p-2 text-center">{{ $item->sort_order }}</td>
                        <td class="p-2 text-gray-500">{{ $item->created_at->format('d-m-Y') }}</td>
                        <td class="p-2 space-x-2">
                            <a href="#"
                               class="text-sm text-blue-600 hover:underline">View</a>
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
