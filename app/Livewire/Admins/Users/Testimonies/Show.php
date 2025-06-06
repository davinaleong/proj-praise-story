<?php

namespace App\Livewire\Admins\Users\Testimonies;

use Livewire\Component;
use App\Models\Testimony;
use App\Models\User;

class Show extends Component
{
    public User $user;
    public Testimony $testimony;

    public function mount(string $uuid, string $testimony_uuid)
    {
        $user = User::where('uuid', $uuid)
            ->firstOrFail();

        session()->put('user', $user);

        $this->user = $user;
        $this->testimony = Testimony::where(['user_id' => $user->id, 'uuid' => $testimony_uuid])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.admins.users.testimonies.show', [
                'title' => 'Users - Testimonies',
                'user' => $this->user,
                'heading' => 'Users - Testimonies',
                'subheading' => 'View single testimony submitted by this user.',
                'testimony' => $this->testimony
            ])
            ->layout('components.layouts.admin', [
                'title' => $this->testimony->title
            ]);
    }
}
