<div class="max-w-3xl mx-auto space-y-6">

    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create a Message</h1>
        <a href="{{ route('admins.messages.index') }}"
           class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
            Cancel
        </a>
    </header>

    <hr class="mb-8 border-gray-300 dark:border-gray-700">

    <form wire:submit.prevent="createMessage" class="space-y-6">
        <div>
            <label class="block text-sm font-medium mb-1">Subject</label>
            <input wire:model.defer="subject" type="text" required
                   class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2" />
            @error('subject') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Body</label>
            <textarea wire:model.defer="body" rows="6" required
                      class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2"></textarea>
            @error('body') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Recipient</label>
            <select wire:model.defer="user_uuid"
                    class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2" required>
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->uuid }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
            @error('user_uuid') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Context Type (optional)</label>
            <input wire:model.defer="context_type" type="text"
                   class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2"
                   placeholder="e.g., App\Models\Testimony" />
            @error('context_type') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Context ID (optional)</label>
            <input wire:model.defer="context_uuid" type="number"
                   class="w-full rounded border border-gray-300 dark:border-zinc-600 p-2" />
            @error('context_uuid') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                Submit
            </button>
        </div>
    </form>

</div>
