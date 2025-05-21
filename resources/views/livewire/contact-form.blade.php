<div class="max-w-xl mx-auto py-12 space-y-6">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Contact</h1>

    @if (session('message'))
        <div class="text-green-600 text-sm font-medium">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        <input type="text" wire:model.defer="honeypot" class="hidden" autocomplete="off">

        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-white mb-1">Subject</label>
            <input type="text" wire:model.defer="subject" class="form-input w-full" required>
            @error('subject') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-white mb-1">Email</label>
            <input type="email" wire:model.defer="email" class="form-input w-full" required>
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-white mb-1">Message</label>
            <textarea wire:model.defer="message" rows="6" class="form-textarea w-full" required></textarea>
            @error('message') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-2 bg-black text-white text-sm rounded hover:bg-gray-800 transition">
                Submit
            </button>
        </div>
    </form>
</div>
