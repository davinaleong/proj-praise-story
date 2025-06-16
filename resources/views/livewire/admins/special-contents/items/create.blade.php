<div class="max-w-3xl mx-auto space-y-6">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create Special Content Item</h1>
        <a href="{{ route('admins.special-contents.items.index') }}"
           class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
            Cancel
        </a>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <form wire:submit.prevent="save" class="space-y-6">
        <div>
            <label class="block text-sm font-medium mb-1">Group</label>
            <select wire:model.defer="group_id" class="w-full border rounded p-2 dark:border-zinc-600" required>
                <option value="">-- Select Group --</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->title }}</option>
                @endforeach
            </select>
            @error('group_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input wire:model.defer="title" type="text"
                   class="w-full border rounded p-2 dark:border-zinc-600" />
            @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Slug</label>
            <input wire:model.defer="slug" type="text"
                   class="w-full border rounded p-2 dark:border-zinc-600" />
            @error('slug') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Type</label>
            <select wire:model.defer="type" class="w-full border rounded p-2 dark:border-zinc-600">
                <option value="">-- Optional --</option>
                @foreach ($types as $enum)
                    <option value="{{ $enum->value }}">{{ ucfirst($enum->value) }}</option>
                @endforeach
            </select>
            @error('type') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Content</label>
            <textarea wire:model.defer="content" rows="4"
                      class="w-full border rounded p-2 dark:border-zinc-600"></textarea>
            @error('content') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Media URL</label>
            <input wire:model.defer="media_url" type="url"
                   class="w-full border rounded p-2 dark:border-zinc-600" />
            @error('media_url') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Link URL</label>
            <input wire:model.defer="link_url" type="url"
                   class="w-full border rounded p-2 dark:border-zinc-600" />
            @error('link_url') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Button Text</label>
            <input wire:model.defer="button_text" type="text"
                   class="w-full border rounded p-2 dark:border-zinc-600" />
            @error('button_text') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Published At</label>
            <input wire:model.defer="published_at" type="datetime-local"
                   class="w-full border rounded p-2 dark:border-zinc-600" />
            @error('published_at') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Sort Order</label>
            <input wire:model.defer="sort_order" type="number" min="0"
                   class="w-full border rounded p-2 dark:border-zinc-600" />
            @error('sort_order') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                Submit
            </button>
        </div>
    </form>

</div>
