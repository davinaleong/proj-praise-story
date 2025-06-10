<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Contact Messages</h1>
        <input type="text" wire:model.debounce.300ms="search"
               placeholder="Search..." class="rounded border px-4 py-2 text-sm" />
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <div class="overflow-x-auto rounded-t-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-900">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700 text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-zinc-800 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                <tr>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Subject</th>
                    <th class="px-6 py-4">Received At</th>
                    <th class="px-6 py-4 text-right">&nbsp;</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($contacts as $contact)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $contact->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::limit($contact->subject, 40) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $contact->created_at->format('Y-m-d H:i') }}
                        </td>
                        <td class="px-6 py-4 flex justify-items-end gap-2">
                            <a href="{{ route('admins.contact-messages.show', ['uuid' => $contact->uuid ]) }}"
                               class="inline-block text-gray-500 hover:text-black dark:hover:text-white" title="View Message">
                                @include('flux.icon.eye')
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No contact messages found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        {{ $contacts->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
