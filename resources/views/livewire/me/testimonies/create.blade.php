<div class="max-w-3xl mx-auto space-y-6">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create a Testimony</h1>
        <a href="{{ $from === 'published' ? route('me.published.index') : route('me.testimonies.index') }}"
           class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
            Cancel
        </a>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <form wire:submit.prevent="submit" class="space-y-6">
        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input wire:model="title" type="text" required class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2" />
            @error('title') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <div class="inline-flex justify-between items-center gap-2 w-full">
                <label class="block text-sm font-medium mb-1">Content</label>

                <a href="{{ route('me.information') }}" class="text-sm text-gray-900 hover:underline dark:text-gray-100">Formatting Help</a>
            </div>
            <textarea wire:model="content" rows="6" required class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2"></textarea>
            @error('content') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select wire:model="status" class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2">
                @foreach($statuses as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('status') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Publish Date</label>
            <input wire:model="published_at" type="date" required class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2" />
            @error('published_at') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                Submit
            </button>
        </div>
    </form>

</div>
