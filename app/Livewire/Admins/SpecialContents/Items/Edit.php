<?php

namespace App\Livewire\Admins\SpecialContents\Items;

use App\Models\SpecialContentItem;
use App\Models\SpecialContentGroup;
use App\Enums\Type;
use Livewire\Component;

class Edit extends Component
{
    public SpecialContentItem $item;

    public $groups;
    public $group_id;
    public $title;
    public $type;
    public $content;
    public $media_url;
    public $link_url;
    public $button_text;
    public $published_at;

    public function mount(string $uuid): void
    {
        $this->item = SpecialContentItem::where('uuid', $uuid)->firstOrFail();

        $this->groups = SpecialContentGroup::pluck('title', 'id')->toArray();

        $this->group_id = $this->item->group_id;
        $this->title = $this->item->title;
        $this->type = $this->item->type;
        $this->content = $this->item->content;
        $this->media_url = $this->item->media_url;
        $this->link_url = $this->item->link_url;
        $this->button_text = $this->item->button_text;
        $this->published_at = optional($this->item->published_at)->format('Y-m-d\TH:i');
    }

    public function update(): void
    {
        $this->validate([
            'group_id' => 'required|exists:special_content_groups,id',
            'title' => 'nullable|string|max:255',
            'type' => 'nullable|in:' . implode(',', array_column(Type::cases(), 'value')),
            'content' => 'nullable|string',
            'media_url' => 'nullable|url',
            'link_url' => 'nullable|url',
            'button_text' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $this->item->update([
            'group_id' => $this->group_id,
            'title' => $this->title,
            'type' => $this->type,
            'content' => $this->content,
            'media_url' => $this->media_url,
            'link_url' => $this->link_url,
            'button_text' => $this->button_text,
            'published_at' => $this->published_at,
        ]);

        session()->flash('success', 'Item updated successfully.');

        redirect()->route('admins.special-contents.items.show', ['uuid' => $this->item->uuid]);
    }

    public function render()
    {
        return view('livewire.admins.special-contents.items.edit', [
            'types' => Type::cases(),
        ])->layout('components.layouts.admin', ['title' => 'Edit Special Content Item']);
    }
}
