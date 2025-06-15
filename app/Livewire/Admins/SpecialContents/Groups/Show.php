<?php

namespace App\Livewire\Admins\SpecialContents\Groups;

use App\Models\SpecialContentGroup;
use Livewire\Component;

class Show extends Component
{
    public SpecialContentGroup $group;

    public function mount(string $uuid)
    {
        $this->group = SpecialContentGroup::where('uuid', $uuid)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.admins.special-contents.groups.show')
            ->layout('components.layouts.admin', ['title' => 'Special Content Groups']);
    }
}
