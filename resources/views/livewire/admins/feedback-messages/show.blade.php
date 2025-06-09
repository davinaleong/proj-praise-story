<div class="max-w-3xl mx-auto py-12 space-y-8">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Feedback Message</h1>
        <a href="{{ route('admins.feedback-messages.index') }}"
           class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
            Back to List
        </a>
    </header>

    <hr class="border-gray-300 dark:border-gray-700 mb-8">

    <section class="space-y-4 text-sm text-gray-800 dark:text-gray-200">
        <div>
            <h2 class="font-semibold">Rating</h2>
            <p class="mt-1">{{ $feedback->rating }} ★</p>
        </div>

        <div>
            <h2 class="font-semibold">Message</h2>
            <p class="mt-1 whitespace-pre-line">{{ $feedback->message ?? '—' }}</p>
        </div>

        <div>
            <h2 class="font-semibold">Submitted At</h2>
            <p class="mt-1">{{ $feedback->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </section>

</div>
