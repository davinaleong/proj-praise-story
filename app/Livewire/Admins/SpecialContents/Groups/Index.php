<?php

namespace App\Livewire\Admins\SpecialContents\Groups;

use App\Models\SpecialContentGroup;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Setting;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $groups = SpecialContentGroup::paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.admins.special-contents.groups.index', [
            'groups' => $groups,
        ])
            ->layout('components.layouts.admin', ['title' => 'Users - Special Content', 'settings' => Setting::ITEMS_PER_PAGE]);;
    }
}
