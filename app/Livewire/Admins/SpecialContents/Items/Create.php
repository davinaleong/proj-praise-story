<?php

namespace App\Livewire\Admins\SpecialContents\Items;

use App\Models\SpecialContentGroup;
use App\Models\SpecialContentItem;
use App\Enums\Type;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public ?int $group_id = null;
    public string $slug = '';
    public ?string $title = '';
    public ?string $type = null;
    public ?string $content = '';
    public ?string $media_url = '';
    public ?string $link_url = '';
    public ?string $button_text = '';
    public ?string $published_at = null; // ISO format

    protected function rules(): array
    {
        return [
            'group_id' => ['required', 'exists:special_content_groups,id'],
            'slug' => ['required', 'string', 'max:255', 'unique:special_content_items,slug'],
            'title' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', Rule::in(array_column(Type::cases(), 'value'))],
            'content' => ['nullable', 'string'],
            'media_url' => ['nullable', 'url'],
            'link_url' => ['nullable', 'url'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
        ];
    }

    public function updatedTitle($value): void
    {
        if (empty($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    public function save(): void
    {
        $this->validate();

        $item = SpecialContentItem::create([
            'uuid' => (string) Str::uuid(),
            'slug' => $this->slug,
            'group_id' => $this->group_id,
            'title' => $this->title,
            'type' => $this->type,
            'content' => $this->content,
            'media_url' => $this->media_url,
            'link_url' => $this->link_url,
            'button_text' => $this->button_text,
            'published_at' => $this->published_at
                ? now()->parse($this->published_at)->toDateTimeString()
                : null,
        ]);

        session()->flash('success', 'Special content item created successfully.');

        redirect()->route('admins.special-contents.items.show', ['uuid' => $item->uuid]);
    }

    public function render()
    {
        return view('livewire.admins.special-contents.items.create', [
            'groups' => SpecialContentGroup::orderBy('title')->get(),
            'types' => Type::cases(),
        ])
            ->layout('components.layouts.admin', ['title' => 'Special Content Groups']);
    }
}
