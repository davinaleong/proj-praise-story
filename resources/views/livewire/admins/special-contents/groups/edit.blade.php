<div class="max-w-3xl mx-auto space-y-6">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Special Content Group</h1>
        <a href="{{ route('admins.special-contents.groups.show', $group) }}"
           class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
            Cancel
        </a>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <form wire:submit.prevent="update" class="space-y-6">
        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input wire:model.defer="title" type="text" required
                   class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2" />
            @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Slug</label>
            <input wire:model.defer="slug" type="text" required
                   class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2" />
            @error('slug') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea wire:model.defer="description" rows="4"
                      class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2"
                      placeholder="Optional description..."></textarea>
            @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select wire:model.defer="status"
                    class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2" required>
                @foreach(\App\Helpers\Status::STATUSES_SPECIAL_CONTENT_GROUP as $statusOption)
                    <option value="{{ $statusOption }}">{{ ucfirst($statusOption) }}</option>
                @endforeach
            </select>
            @error('status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Sort Order</label>
            <input wire:model.defer="sort_order" type="number" min="0"
                   class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2" />
            @error('sort_order') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                Update
            </button>
        </div>
    </form>

</div>
