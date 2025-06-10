<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Page Header --}}
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Users</h1>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    {{-- User Table --}}
    <div class="overflow-x-auto rounded-t-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-900">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700 text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-zinc-800 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                <tr>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Registered At</th>
                    <th class="px-6 py-4 text-right">&nbsp;</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4 capitalize">{{ $user->status ?? '—' }}</td>
                        <td class="px-6 py-4">{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 flex justify-items-end gap-2">
                            {{-- Optional: action buttons --}}
                            <a href="{{ route('admins.users.show', ['uuid' => $user->uuid]) }}"
                               class="inline-block text-gray-500 hover:text-black dark:hover:text-white" title="View User">
                                @include('flux.icon.eye')
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No users found.
                        </td>
                    </tr>
                @endforelse
                <tfoot>
                    <tr>
                        <td colspan="5">
                            {{ $users->links() }}
                        </td>
                    </tr>
                </tfoot>
            </tbody>
        </table>
    </div>
</div>
