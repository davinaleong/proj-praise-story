<x-layouts.app title="Edit Testimony">
    <h1>Testimonies</h1>

    <h2>Edit: {{ $testimony->title }}</h2>

    <nav class="mb-4">
        <a href="{{ route('me.testimonies.show', $testimony->uuid) }}">Back</a>
    </nav>

    <form wire:submit.prevent="update">
        <div>
            <label for="input-title">Title*</label>
            <input type="text" id="input-title" wire:model.defer="title" required>
            @error('title') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="input-content">Content*</label>
            <textarea id="input-content" rows="10" wire:model.defer="content" required></textarea>
            @error('content') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="input-status">Status*</label>
            <select id="input-status" wire:model.defer="status" required>
                @foreach($statuses as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('status') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="input-published_at">Published At*</label>
            <input type="date" id="input-published_at" wire:model.defer="published_at" required>
            @error('published_at') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mt-4">
            <button type="reset">Reset</button>
            <button type="submit">Update</button>
        </div>
    </form>
</x-layouts.app>
