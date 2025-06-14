<?php

namespace App\Livewire\Admins\SpecialContents\Groups;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.admins.special-contents.groups.create')
            ->layout('components.layouts.admin', ['title' => 'Special Content Groups']);
    }
}
