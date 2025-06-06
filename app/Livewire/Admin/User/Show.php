<?php

namespace App\Livewire\Admin\User;

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
                'title' => 'User Profile',
                'user' => $this->user,
                'heading' => 'User Profile',
                'subheading' => 'This is a read-only view of user details.',
            ])
            ->layout('components.layouts.admin', ['title' => 'Users']);
    }
}
