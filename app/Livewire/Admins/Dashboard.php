<?php

namespace App\Livewire\Admins;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admins.dashboard')
            ->layout('components.layouts.admin', ['title' => 'Dashboard']);
    }
}
