<?php

namespace App\Livewire\Me\PublishedTestimonies;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Testimony;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Status;
use App\Helpers\Setting;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $testimonies = Testimony::where('user_id', Auth::id())
            ->whereIn('status', [
                Status::STATUS_TESTIMONY_PUBLIC,
                Status::STATUS_TESTIMONY_PRIVATE,
                Status::STATUS_TESTIMONY_PUBLISHED,
            ])
            ->orderByDesc('published_at')
            ->paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.me.published-testimonies.index', compact('testimonies'))
            ->layout('components.layouts.me', ['title' => 'My Published Testimonies']);
    }
}
