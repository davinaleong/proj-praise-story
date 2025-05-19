<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Page Header --}}
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">My Testimonies</h1>
        @include('partials.create-button')
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    {{-- Testimony Table --}}
    <div class="overflow-x-auto rounded-t-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-900">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700 text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-zinc-800 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                <tr>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Published At</th>
                    <th class="px-6 py-4 text-right">&nbsp;</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse ($testimonies as $testimony)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $testimony->title }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ $testimony->status }}
                        </td>
                        <td class="px-6 py-4">
                            {{ optional($testimony->published_at)->format('Y-m-d') ?? '—' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('me.testimonies.show', $testimony->uuid) }}"
                               class="inline-block text-gray-500 hover:text-black dark:hover:text-white" title="View Testimony">
                                @include('flux.icon.eye')
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No testimonies found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
