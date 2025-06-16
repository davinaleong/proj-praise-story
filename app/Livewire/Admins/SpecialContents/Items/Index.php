<?php

namespace App\Livewire\Admins\SpecialContents\Items;

use App\Models\SpecialContentItem;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Setting;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $items = SpecialContentItem::with('SpecialContentGroup')->paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.admins.special-contents.items.index', [
            'items' => $items,
        ])
            ->layout('components.layouts.admin', ['title' => 'Special Content Groups']);
    }
}
