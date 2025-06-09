<div class="max-w-3xl mx-auto py-12 space-y-8">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Testimony Details</h1>
        <a href="{{ route('admins.testimonies.index') }}"
           class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
            Back to List
        </a>
    </header>

    <hr class="border-gray-300 dark:border-gray-700 mb-8">

    <section class="space-y-4 text-sm text-gray-800 dark:text-gray-200">
        <div>
            <h2 class="font-semibold">Title</h2>
            <p class="mt-1">{{ $testimony->title }}</p>
        </div>

        <div>
            <h2 class="font-semibold">Content</h2>
            <p class="mt-1 whitespace-pre-line">{{ $testimony->content }}</p>
        </div>

        <div>
            <h2 class="font-semibold">Author</h2>
            <p class="mt-1">{{ $testimony->user->name ?? '—' }}</p>
        </div>

        <div>
            <h2 class="font-semibold">Status</h2>
            <p class="mt-1 capitalize">{{ $testimony->status }}</p>
        </div>

        <div>
            <h2 class="font-semibold">Published At</h2>
            <p class="mt-1">{{ optional($testimony->published_at)->format('Y-m-d H:i') ?? '—' }}</p>
        </div>
    </section>
</div>
