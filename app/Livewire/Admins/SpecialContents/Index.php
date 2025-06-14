<?php

namespace App\Livewire\Admins\SpecialContents;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admins.special-contents.index')
            ->layout('components.layouts.admin', ['title' => 'Users - Special Content']);
    }
}
