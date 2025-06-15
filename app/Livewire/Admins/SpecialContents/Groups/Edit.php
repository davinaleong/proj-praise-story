<?php

namespace App\Livewire\Admins\SpecialContents\Groups;

use App\Models\SpecialContentGroup;
use App\Helpers\Status;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public SpecialContentGroup $group;
    public string $title;
    public string $slug;
    public ?string $description = '';
    public string $status;
    public int $sort_order = 0;

    public function mount(string $uuid): void
    {
        $group = SpecialContentGroup::where('uuid', $uuid)
            ->firstOrFail();

        $this->group = $group;
        $this->title = $group->title;
        $this->slug = $group->slug;
        $this->description = $group->description ?? '';
        $this->status = $group->status;
        $this->sort_order = $group->sort_order ?? 0;
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('special_content_groups', 'slug')->ignore($this->group->id),
            ],
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(Status::STATUSES_SPECIAL_CONTENT_GROUP)],
            'sort_order' => 'required|integer|min:0',
        ];
    }

    public function updatedTitle($value): void
    {
        if ($this->slug === $this->group->slug) {
            $this->slug = Str::slug($value);
        }
    }

    public function update(): void
    {
        $this->validate();

        $this->group->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
        ]);

        session()->flash('success', 'Special Content Group updated successfully.');

        redirect()->route('admins.special-contents.groups.show', ['uuid' => $this->group->uuid]);
    }

    public function render()
    {
        return view('livewire.admins.special-contents.groups.edit')
            ->layout('components.layouts.admin', ['title' => 'Special Content Groups']);
    }
}
