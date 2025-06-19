<?php

namespace App\Livewire\SpecialContent;

use App\Models\SpecialContentGroup;
use Livewire\Component;

class Show extends Component
{
    public SpecialContentGroup $group;

    public function mount(string $uuid)
    {
        $this->group = SpecialContentGroup::with('items')->where('uuid', $uuid)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.special-content.show', [
            'group' => $this->group,
            'items' => $this->group->items,
        ]);
    }
}
