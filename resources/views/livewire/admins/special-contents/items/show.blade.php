<div class="max-w-3xl mx-auto space-y-6">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            {{ $item->title ?? 'Untitled Item' }}
        </h1>
        <div class="flex items-center gap-2">
            <a href="#"
                class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
                Edit
            </a>
            <span>|</span>
            <a href="{{ route('admins.special-contents.items.index') }}"
                class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
                Back
            </a>
            <span>|</span>
            <form wire:submit.prevent="delete" class="inline">
                <button type="submit"
                        class="text-sm text-red-600 dark:text-red-400 hover:underline"
                        onclick="return confirm('Are you sure you want to delete this item?');">
                    Delete
                </button>
            </form>
        </div>
    </header>

    <hr class="mb-6 border-gray-300 dark:border-gray-700">

    <div class="space-y-4">
        <div>
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Slug</h2>
            <p class="text-gray-900 dark:text-white">{{ $item->slug }}</p>
        </div>

        <div>
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Type</h2>
            <p class="text-gray-900 dark:text-white">{{ $item->type }}</p>
        </div>

        <div>
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Content</h2>
            <p class="text-gray-900 dark:text-white whitespace-pre-line">{{ $item->content ?: '—' }}</p>
        </div>

        <div>
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Media URL</h2>
            <p class="text-gray-900 dark:text-white">{{ $item->media_url ?: '—' }}</p>
        </div>

        <div>
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Link URL</h2>
            <p class="text-gray-900 dark:text-white">{{ $item->link_url ?: '—' }}</p>
        </div>

        <div>
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Button Text</h2>
            <p class="text-gray-900 dark:text-white">{{ $item->button_text ?: '—' }}</p>
        </div>

        <div>
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Published At</h2>
            <p class="text-gray-900 dark:text-white">
                {{ $item->published_at ? $item->published_at->format('d-m-Y H:i') : '—' }}
            </p>
        </div>
    </div>
</div>
