<div class="max-w-3xl mx-auto py-12 space-y-8">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Contact Message</h1>
        <a href="{{ route('admins.contacts.index') }}"
           class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
            Back to List
        </a>
    </header>

    <hr class="border-gray-300 dark:border-gray-700 mb-8">

    <section class="space-y-4 text-sm text-gray-800 dark:text-gray-200">
        <div>
            <h2 class="font-semibold">Email</h2>
            <p class="mt-1">{{ $contact->email }}</p>
        </div>

        <div>
            <h2 class="font-semibold">Subject</h2>
            <p class="mt-1">{{ $contact->subject }}</p>
        </div>

        <div>
            <h2 class="font-semibold">Message</h2>
            <p class="mt-1 whitespace-pre-line">{{ $contact->message }}</p>
        </div>

        <div>
            <h2 class="font-semibold">Received At</h2>
            <p class="mt-1">{{ $contact->created_at->format('d-m-Y H:i') }}</p>
        </div>
    </section>

</div>
