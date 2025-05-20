<?php

namespace App\Livewire\TermsAndConditions;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Show extends Component
{
    public function render()
    {
        return view('livewire.terms-and-conditions.show')
            ->layout('components.layouts.app');
    }
}
