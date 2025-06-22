<div wire:init="loadTestimonies" class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    {{-- Page Header --}}
    <header class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
    </header>

    <hr class="mt-4 border-gray-300 dark:border-gray-700">

    @if ($readyToLoad)
        {{-- Summary Cards --}}
        <section class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="flex flex-col items-center justify-center aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 p-4">
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Public Testimonies</h2>
                {{-- Public Testimonies --}}
                <p x-data="{ count: 0 }"
                x-init="let final = {{ $counts['public'] }};
                        let step = Math.ceil(final / 30);
                        setTimeout(() => {
                            let i = setInterval(() => {
                                count += step;
                                if (count >= final) {
                                    count = final;
                                    clearInterval(i);
                                }
                            }, 150);
                        }, 1000);"
                x-text="count"
                class="text-3xl font-bold text-black dark:text-white mt-2">
                </p>
            </div>
            <div class="flex flex-col items-center justify-center aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 p-4">
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Private Testimonies</h2>
                {{-- Private Testimonies --}}
                <p x-data="{ count: 0 }"
                x-init="let final = {{ $counts['private'] }};
                        let step = Math.ceil(final / 30);
                        setTimeout(() => {
                            let i = setInterval(() => {
                                count += step;
                                if (count >= final) {
                                    count = final;
                                    clearInterval(i);
                                }
                            }, 150);
                        }, 1300);"
                x-text="count"
                class="text-3xl font-bold text-black dark:text-white mt-2">
                </p>
            </div>
            <div class="flex flex-col items-center justify-center aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 p-4">
                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Published</h2>
                {{-- Total Published --}}
                <p x-data="{ count: 0 }"
                x-init="let final = {{ $counts['published'] }};
                        let step = Math.ceil(final / 30);
                        setTimeout(() => {
                            let i = setInterval(() => {
                                count += step;
                                if (count >= final) {
                                    count = final;
                                    clearInterval(i);
                                }
                            }, 150);
                        }, 1800);"
                x-text="count"
                class="text-3xl font-bold text-black dark:text-white mt-2">
                </p>
            </div>
        </section>

        {{-- Testimony Table --}}
        <section class="relative h-full flex-1 overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900">
            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-100 dark:bg-zinc-800 text-xs uppercase font-medium">
                    <tr>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Likes</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Published At</th>
                        <th scope="col" class="px-6 py-3">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($testimonies as $testimony)
                        <tr class="border-t border-gray-200 dark:border-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-800">
                            <td class="px-6 py-4 font-medium">{{ $testimony->title }}</td>
                            <td>
                                @include('partials.likes-bar')
                            </td>
                            <td class="px-6 py-4 capitalize">{{ $testimony->status }}</td>
                            <td class="px-6 py-4">
                                {{ optional($testimony->published_at)->format('Y-m-d') ?? '—' }}
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('me.testimonies.show', $testimony->uuid) }}">
                                    @include('flux.icon.eye')
                                </a>
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
        </section>
    @else
        <div class="text-center py-12 text-gray-500 dark:text-gray-400">
            Loading testimonies...
        </div>
    @endif
</div>
