<?php

namespace App\Livewire\Private\Testimonies;

use Livewire\Component;
use App\Models\Testimony;
use App\Helpers\Status;

class Show extends Component
{
    public Testimony $testimony;

    public function mount(string $uuid): void
    {
        $this->testimony = Testimony::with('user')
            ->where('uuid', $uuid)
            ->whereIn('status', [Status::STATUS_TESTIMONY_PUBLIC, Status::STATUS_TESTIMONY_PUBLIC])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.private.testimonies.show')
            ->layout('components.layouts.app', [
                'title' => $this->testimony->title,
            ]);
    }
}
