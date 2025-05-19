<?php

namespace App\Livewire\Me;

use Livewire\Component;

class Information extends Component
{
    public function render()
    {
        return view('livewire.me.information')
            ->layout('components.layouts.me', ['title' => 'Information']);
    }
}
