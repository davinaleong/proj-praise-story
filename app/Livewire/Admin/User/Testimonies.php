<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Testimony;
use App\Models\User;
use App\Helpers\Setting;

class Testimonies extends Component
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
        $testimonies = Testimony::where('user_id', $this->user->id)
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->paginate(Setting::ITEMS_PER_PAGE_100);

        // return view('livewire.admins.users.testimonies');

        return view('livewire.admins.users.testimonies', [
                'title' => 'Users - Testimonies',
                'user' => $this->user,
                'heading' => 'Users - Testimonies',
                'subheading' => 'View all testimonies submitted by this user.',
                'testimonies' => $testimonies
            ])
            ->layout('components.layouts.admin', ['title' => 'Users - Testimonies']);
    }
}
