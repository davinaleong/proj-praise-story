<?php

namespace App\Livewire\Testimonies;

use Livewire\Component;
use App\Models\Testimony;
use App\Helpers\Status;

class Show extends Component
{
    public Testimony $testimony;

    public function mount(string $uuid)
    {
        $this->testimony = Testimony::where('uuid', $uuid)
            ->where('status', Status::STATUS_TESTIMONY_PUBLIC)
            ->firstOr(fn() => abort(404));
    }

    public function render()
    {
        return view('livewire.testimonies.show')
            ->layout('components.layouts.app', [
                'title' => $this->testimony->title,
            ]);
    }
}
