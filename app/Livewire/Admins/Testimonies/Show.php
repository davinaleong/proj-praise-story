<?php

namespace App\Livewire\Admins\Testimonies;

use App\Models\Testimony;
use Livewire\Component;

class Show extends Component
{
    public Testimony $testimony;

    public function mount(string $uuid): void
    {
        $this->testimony = Testimony::with('user')->where('uuid', $uuid)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.admins.testimonies.show', [
            'testimony' => $this->testimony,
        ])->layout('components.layouts.admin', [
            'title' => 'View Testimony',
        ]);
    }
}
