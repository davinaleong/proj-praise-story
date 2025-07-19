<?php

namespace App\Http\Livewire\Me\Testimonies;

use Livewire\Component;

class ExportTestimonies extends Component
{
    public function download()
    {
        // Redirect to the export route
        return redirect()->route('me.testimonies.export');
    }

    public function render()
    {
        return view('livewire.me.export-testimonies')
            ->layout('components.layouts.me', ['title' => 'Create Testimony']);
    }
}
