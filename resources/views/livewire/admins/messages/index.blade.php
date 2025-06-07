<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Page Header --}}
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Messages</h1>
        <a href="#"
            class="inline-flex items-center gap-2 bg-black text-white dark:bg-white dark:text-black font-semibold text-sm px-5 py-2 rounded-md transition hover:opacity-90">
            @include('flux.icon.plus') Create Message
        </a>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    {{-- Message Table --}}
    <div class="overflow-x-auto rounded-t-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-900">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700 text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-zinc-800 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                <tr>
                    <th class="px-6 py-4">Subject</th>
                    <th class="px-6 py-4">Recipient</th>
                    <th class="px-6 py-4">Context</th>
                    <th class="px-6 py-4">Sent At</th>
                    <th class="px-6 py-4 text-right">&nbsp;</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($messages as $message)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $message->subject }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $message->user->name ?? '—' }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($message->context)
                                {{ class_basename($message->context_type) }}
                            @else
                                —
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ optional($message->sent_at)->format('Y-m-d H:i') ?? '—' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            {{-- Optional action link --}}
                            <a href="#"
                               class="inline-block text-gray-500 hover:text-black dark:hover:text-white"
                               title="View Message">
                                @include('flux.icon.eye')
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No messages found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
