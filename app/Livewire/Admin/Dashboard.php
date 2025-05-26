<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'testimonyCount' => 0,
            'contactCount' => 0,
            'feedbackCount' => 0,
        ])
            ->layout('components.layouts.admin', ['title' => 'Dashboard (Admin)']);
    }
}
