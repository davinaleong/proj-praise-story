<form wire:submit.prevent="submit" class="space-y-6 max-w-2xl">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Contact</h1>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    {{-- Honeypot Field --}}
    <input type="text" wire:model.defer="honeypot" class="hidden" autocomplete="off">

    {{-- Subject --}}
    <div>
        <label class="block text-sm font-medium text-gray-900 dark:text-white mb-1">Subject</label>
        <input type="text"
               wire:model.defer="subject"
               class="block w-full rounded-md border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-sm text-gray-900 dark:text-white focus:ring-1 focus:ring-black focus:border-black px-3 py-2 shadow-sm"
        >
        @error('subject') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Email --}}
    <div>
        <label class="block text-sm font-medium text-gray-900 dark:text-white mb-1">Email</label>
        <input type="email"
               wire:model.defer="email"
               class="block w-full rounded-md border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-sm text-gray-900 dark:text-white focus:ring-1 focus:ring-black focus:border-black px-3 py-2 shadow-sm"
        >
        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Message --}}
    <div>
        <label class="block text-sm font-medium text-gray-900 dark:text-white mb-1">Message</label>
        <textarea
            wire:model.defer="message"
            rows="6"
            class="block w-full rounded-md border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-sm text-gray-900 dark:text-white focus:ring-1 focus:ring-black focus:border-black px-3 py-2 shadow-sm resize-none"
        ></textarea>
        @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Submit Button --}}
    <div class="flex justify-end">
        <button type="submit"
                class="px-6 py-2 rounded-md bg-black text-white text-sm font-medium hover:bg-gray-800 transition"
        >
            Submit
        </button>
    </div>
</form>
