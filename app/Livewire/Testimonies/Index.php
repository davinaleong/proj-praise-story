<?php

namespace App\Livewire\Testimonies;

use Livewire\Component;
use App\Models\Testimony;
use App\Helpers\Status;
use App\Helpers\Setting;

class Index extends Component
{
    public function render()
    {
        return view('livewire.testimonies.index', [
            'testimonies' => Testimony::where('status', Status::STATUS_TESTIMONY_PUBLIC)->latest('published_at')->paginate(Setting::ITEMS_PER_PAGE_100)
        ]);
    }

}
