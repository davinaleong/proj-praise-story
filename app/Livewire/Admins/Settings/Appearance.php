<?php

namespace App\Livewire\Admins\Settings;

use Livewire\Component;

class Appearance extends Component
{
    public function render()
    {
        return view('livewire.settings.appearance')
            ->layout('components.layouts.admin', ['title' => 'Appearance Settings']);
    }
}
