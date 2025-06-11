<?php

namespace App\Livewire\Admins\Testimonies;

use App\Models\Testimony;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Setting;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $testimonies = Testimony::paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.admins.testimonies.index', [
            'testimonies' => $testimonies,
        ])->layout('components.layouts.admin', [
            'title' => 'Testimonies',
        ]);
    }
}
