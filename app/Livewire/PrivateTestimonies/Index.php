<?php

namespace App\Livewire\PrivateTestimonies;

use Livewire\Component;
use App\Models\Testimony;
use App\Helpers\Status;
use App\Helpers\Setting;

class Index extends Component
{
    public function render()
    {
        return view('livewire.private-testimonies.index', [
            'testimonies' => Testimony::whereIn('status', [Status::STATUS_TESTIMONY_PUBLIC, Status::STATUS_TESTIMONY_PRIVATE])->latest('published_at')->paginate(Setting::ITEMS_PER_PAGE_100)
        ]);
    }
}
