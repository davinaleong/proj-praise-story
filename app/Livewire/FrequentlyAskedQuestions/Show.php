<?php

namespace App\Livewire\FrequentlyAskedQuestions;

use Livewire\Component;

class Show extends Component
{
    public function render()
    {
        return view('livewire.frequently-asked-questions.show')
            ->layout('components.layouts.app', ['title' => 'Frequently Askec Questions']);
    }
}
