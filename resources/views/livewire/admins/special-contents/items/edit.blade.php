<div class="max-w-3xl mx-auto space-y-6">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            {{ $item->title ?? 'Untitled Item' }}
        </h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('admins.special-contents.items.show', ['uuid' => $item->uuid]) }}"
                class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
                Back
            </a>
        </div>
    </header>

    <form wire:submit.prevent="update" class="space-y-4">

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Group</label>
            <select wire:model="group_id" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-800 dark:text-white">
                @foreach ($groups as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            @error('group_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <input type="text" wire:model.defer="title" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-800 dark:text-white" />
            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
            <select wire:model="type" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-800 dark:text-white">
                <option value="">—</option>
                @foreach ($types as $enum)
                    <option value="{{ $enum->value }}">{{ ucfirst($enum->value) }}</option>
                @endforeach
            </select>
            @error('type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
            <textarea wire:model.defer="content" rows="4" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-800 dark:text-white"></textarea>
            @error('content') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Media URL</label>
            <input type="url" wire:model.defer="media_url" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-800 dark:text-white" />
            @error('media_url') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Link URL</label>
            <input type="url" wire:model.defer="link_url" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-800 dark:text-white" />
            @error('link_url') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Button Text</label>
            <input type="text" wire:model.defer="button_text" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-800 dark:text-white" />
            @error('button_text') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Published At</label>
            <input type="datetime-local" wire:model.defer="published_at" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-800 dark:text-white" />
            @error('published_at') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="pt-4">
            <button type="submit"
                class="px-4 py-2 rounded bg-black text-white dark:bg-white dark:text-black hover:opacity-90">
                Save
            </button>
        </div>
    </form>
</div>
