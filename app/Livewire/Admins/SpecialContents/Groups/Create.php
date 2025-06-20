<?php

namespace App\Livewire\Admins\SpecialContents\Groups;

use App\Models\SpecialContentGroup;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Helpers\Status;
use Illuminate\Validation\Rule;

class Create extends Component
{
    public string $title = '';
    public string $slug = '';
    public string $description = '';
    public string $status = Status::STATUS_SPECIAL_CONTENT_GROUP_DRAFT;
    public int $sort_order = 0;

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:special_content_groups,slug',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(Status::STATUSES_SPECIAL_CONTENT_GROUP)],
            'sort_order' => 'required|integer|min:0',
        ];
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        $group = SpecialContentGroup::create([
            'uuid' => Str::uuid(),
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
        ]);

        session()->flash('success', 'Special Content Group created successfully.');

        return redirect()->route('admins.special-contents.groups.show', ['uuid' => $group->uuid]);
    }

    public function render()
    {
        return view('livewire.admins.special-contents.groups.create')
            ->layout('components.layouts.admin', ['title' => 'Special Content Groups']);
    }
}
