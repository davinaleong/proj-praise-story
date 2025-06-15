<div class="max-w-3xl mx-auto space-y-6">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            {{ $group->title }}
        </h1>
        <flex class="flex gap-2">
            <a href="{{ route('admins.special-contents.groups.edit', ['uuid' => $group->uuid]) }}"
           class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
                Edit
            </a>
            <span>|</span>
            <a href="{{ route('admins.special-contents.groups.index') }}"
           class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
                Back
            </a>
        </flex>
    </header>

    <hr class="mb-6 border-gray-300 dark:border-gray-700">

    <div class="space-y-4">
        <div>
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Slug</h2>
            <p class="text-gray-900 dark:text-white">{{ $group->slug }}</p>
        </div>

        <div>
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Description</h2>
            <p class="text-gray-900 dark:text-white">{{ $group->description ?: '—' }}</p>
        </div>

        <div>
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Status</h2>
            <p class="text-gray-900 dark:text-white capitalize">{{ $group->status }}</p>
        </div>

        <div>
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Sort Order</h2>
            <p class="text-gray-900 dark:text-white">{{ $group->sort_order }}</p>
        </div>
    </div>

</div>
