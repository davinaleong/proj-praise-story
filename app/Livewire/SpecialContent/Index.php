<?php

namespace App\Livewire\SpecialContent;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SpecialContentGroup;
use App\Helpers\Setting;

class Index extends Component
{
    use WithPagination;

    /**
     * Renders the paginated list of special content groups.
     */
    public function render()
    {
        $groups = SpecialContentGroup::paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.special-content.index', [
            'groups' => $groups,
        ]);
    }
}
