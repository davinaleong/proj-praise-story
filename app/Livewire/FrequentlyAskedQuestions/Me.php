<?php

namespace App\Livewire\FrequentlyAskedQuestions;

use Livewire\Component;

class Me extends Component
{
    public function render()
    {
        return view('livewire.frequently-asked-questions.me')
            ->layout('components.layouts.me');
    }
}
