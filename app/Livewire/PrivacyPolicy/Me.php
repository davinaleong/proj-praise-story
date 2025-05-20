<?php

namespace App\Livewire\PrivacyPolicy;

use Livewire\Component;

class Me extends Component
{
    public function render()
    {
        return view('livewire.privacy-policy.me')
            ->layout('components.layouts.me');
    }
}
