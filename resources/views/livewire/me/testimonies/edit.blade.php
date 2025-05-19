<div class="max-w-3xl mx-auto space-y-6">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Testimony</h1>
        <a href="{{ route('me.testimonies.show', $testimony->uuid) }}"
           class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
            Cancel
        </a>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <form wire:submit.prevent="update" class="space-y-6">

        <div>
            <label class="block text-sm font-medium mb-1" for="input-title">Title</label>
            <input wire:model.defer="title"
                   type="text"
                   id="input-title"
                   required
                   class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2">
            @error('title') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1" for="input-content">Content</label>
            <textarea wire:model.defer="content"
                      id="input-content"
                      rows="6"
                      required
                      class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2"></textarea>
            @error('content') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1" for="input-status">Status</label>
            <select wire:model.defer="status"
                    id="input-status"
                    class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2">
                @foreach($statuses as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('status') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1" for="input-published_at">Publish Date</label>
            <input wire:model.defer="published_at"
                   type="date"
                   id="input-published_at"
                   required
                   class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2">
            @error('published_at') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition">
                Update
            </button>
        </div>
    </form>
</div>
