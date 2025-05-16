<form wire:submit.prevent="submit">
    <input wire:model="title" type="text" required />
    <textarea wire:model="content" required></textarea>
    <select wire:model="status">
        @foreach($statuses as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
        @endforeach
    </select>
    <input wire:model="published_at" type="date" required />
    <button type="submit">Submit</button>
</form>
