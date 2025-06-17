<?php

namespace App\Livewire\Admins\SpecialContents\Items;

use App\Models\SpecialContentItem;
use Livewire\Component;

class Show extends Component
{
    public SpecialContentItem $item;

    public function mount(string $uuid): void
    {
        $this->item = SpecialContentItem::where('uuid', $uuid)
            ->firstOrFail();
    }

    public function delete()
    {
        $this->item->delete();

        return redirect()->route('admins.special-contents.items.index');
    }

    public function render()
    {
        return view('livewire.admins.special-contents.items.show')
            ->layout('components.layouts.admin', ['title' => 'Special Content Item']);
    }
}
