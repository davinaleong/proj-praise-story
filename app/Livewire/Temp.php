<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Temp extends Component
{
    public function render()
    {
        $users = User::all();

        return view('livewire.temp', compact('users'));
    }
}
