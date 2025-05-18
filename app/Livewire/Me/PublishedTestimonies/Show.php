<?php

namespace App\Livewire\Me\PublishedTestimonies;

use Livewire\Component;
use App\Models\Testimony;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Status;

class Show extends Component
{
    public Testimony $testimony;

    public function mount(string $uuid): void
    {
        $this->testimony = Testimony::with('user')
            ->where('uuid', $uuid)
            ->where('user_id', Auth::id())
            ->whereIn('status', [
                Status::STATUS_TESTIMONY_PUBLIC,
                Status::STATUS_TESTIMONY_PRIVATE,
                Status::STATUS_TESTIMONY_PUBLISHED,
            ])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.me.published-testimonies.show')
            ->layout('components.layouts.me', ['title' => $this->testimony->title]);
    }
}

