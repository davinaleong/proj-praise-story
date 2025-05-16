<?php

namespace App\Http\Livewire\Testimonies;

use Livewire\Component;
use App\Models\Testimony;
use Illuminate\Support\Str;

class Show extends Component
{
    public Testimony $testimony;

    public function mount(string $uuid): void
    {
        $this->testimony = Testimony::with('user')
            ->where('uuid', $uuid)
            ->where('status', 'public')
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.testimonies.show')
            ->layout('layouts.app', [
                'title' => $this->testimony->title,
            ]);
    }
}
