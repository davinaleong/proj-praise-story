<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">All Special Content Groups</h1>

        <a href="{{ route('admins.special-contents.groups.create') }}"
            class="inline-flex items-center gap-2 bg-black text-white dark:bg-white dark:text-black font-semibold text-sm px-5 py-2 rounded-md transition hover:opacity-90">
            @include('flux.icon.plus') Create Special Content
        </a>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <div class="overflow-x-auto rounded-t-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-900">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700 text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-zinc-800 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                <tr>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Slug</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Sort</th>
                    <th class="px-6 py-4">Created At</th>
                    <th class="px-6 py-4 text-right flex gap-2">&nbsp;</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($groups as $group)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $group->title }}
                        </td>
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                            {{ $group->slug }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ $group->status }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $group->sort_order }}
                        </td>
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                            {{ $group->created_at->format('d-m-Y') }}
                        </td>
                        <td class="px-6 py-4 flex justify-items-end gap-2">
                            <a href="#"
                               class="inline-block text-gray-500 hover:text-black dark:hover:text-white" title="View Group">
                                @include('flux.icon.eye')
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No special content groups found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">{{ $groups->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
