<?php

namespace App\Livewire\SpecialContent;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SpecialContentGroup;
use App\Helpers\Setting;
use App\Helpers\Status;

class Index extends Component
{
    use WithPagination;

    /**
     * Renders the paginated list of special content groups.
     */
    public function render()
    {
        $groups = SpecialContentGroup::whereIn('status', [Status::STATUS_SPECIAL_CONTENT_GROUP_PUBLIC, Status::STATUS_SPECIAL_CONTENT_GROUP_PRIVATE])->paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.special-content.index', [
            'groups' => $groups,
        ]);
    }
}
