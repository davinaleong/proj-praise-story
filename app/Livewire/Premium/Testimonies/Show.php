<?php

namespace App\Livewire\Premium\Testimonies;

use Livewire\Component;
use App\Models\Testimony;

class Show extends Component
{
    public Testimony $testimony;

    public function mount(string $uuid): void
    {
        $this->testimony = Testimony::with('user')
            ->where('uuid', $uuid)
            ->whereIn('status', ['public', 'private'])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.premium.testimonies.show')
            ->layout('components.layouts.app', [
                'title' => $this->testimony->title,
            ]);
    }
}
