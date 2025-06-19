<x-layouts.app :title="$group->title">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ $group->title }}
            </h1>

            @include('partials.private-nav')
        </header>

        <hr class="mb-8 border-gray-300 dark:border-gray-700">

        <section class="space-y-6">
            @forelse ($items as $item)
                <div class="rounded-lg border p-6 shadow-sm border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white">
                    <h2 class="text-lg font-semibold">
                        {{ $item->title }}
                    </h2>
                    @if ($item->content)
                        <p class="text-sm mt-2 text-gray-700 dark:text-gray-300">
                            {{ Str::limit($item->content, 120) }}
                        </p>
                    @endif

                    @if ($item->link_url)
                        <a href="{{ $item->link_url }}"
                           class="inline-block mt-4 text-sm font-bold underline"
                           target="_blank" rel="noopener">
                            {{ $item->button_text ?? 'Open link' }}
                        </a>
                    @endif
                </div>
            @empty
                <p class="text-center text-gray-600 dark:text-gray-400">
                    No special content items found.
                </p>
            @endforelse
        </section>

        @include('partials.footer')
    </div>
</x-layouts.app>
