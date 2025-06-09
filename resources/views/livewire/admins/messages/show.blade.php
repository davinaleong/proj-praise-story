<div class="max-w-3xl mx-auto py-12 space-y-8">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Message Details</h1>
        <a href="{{ route('admins.messages.index') }}"
           class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
            Back to Messages
        </a>
    </header>

    <hr class="border-gray-300 dark:border-gray-700 mb-8">

    <section class="space-y-4 text-sm text-gray-800 dark:text-gray-200">
        <div>
            <h2 class="font-semibold text-gray-900 dark:text-white">Subject</h2>
            <p class="mt-1">{{ $message->subject }}</p>
        </div>

        <div>
            <h2 class="font-semibold text-gray-900 dark:text-white">Body</h2>
            <div class="mt-1 whitespace-pre-line">{{ $message->body }}</div>
        </div>

        <div>
            <h2 class="font-semibold text-gray-900 dark:text-white">Recipient</h2>
            <p class="mt-1">{{ $message->user->name ?? '—' }} ({{ $message->user->email ?? '—' }})</p>
        </div>

        <div>
            <h2 class="font-semibold text-gray-900 dark:text-white">Admin Sender</h2>
            <p class="mt-1">{{ $message->admin->name ?? 'System' }}</p>
        </div>

        <div>
            <h2 class="font-semibold text-gray-900 dark:text-white">Context</h2>
            @if ($message->context)
                <p class="mt-1">{{ class_basename($message->context_type) }} (ID: {{ $message->context_id }})</p>
            @else
                <p class="mt-1">—</p>
            @endif
        </div>

        <div>
            <h2 class="font-semibold text-gray-900 dark:text-white">Sent At</h2>
            <p class="mt-1">
                {{ $message->sent_at?->format('d-m-Y H:i') ?? 'Not sent yet' }}
            </p>
        </div>
    </section>

</div>
