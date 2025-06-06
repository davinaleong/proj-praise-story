<?php

namespace App\Livewire\Admins\Users;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public User $user;

    public function mount(string $uuid)
    {
        $this->user = User::where('uuid', $uuid)
            ->firstOrFail();

        session()->put('user', $this->user);
    }

    public function render()
    {
        return view('livewire.admins.users.show', [
                'title' => 'Users - View Profile',
                'user' => $this->user,
                'heading' => 'Users - View Profile',
                'subheading' => 'This is a read-only view of user details.',
            ])
            ->layout('components.layouts.admin', ['title' => 'Users - View Profile']);
    }
}
