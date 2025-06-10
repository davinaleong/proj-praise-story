<?php

namespace App\Livewire\Admins\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Setting;

class Index extends Component
{
    use WithPagination;
    public function render()
    {
        $users = User::paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.admins.users.index', ['users' => $users])
            ->layout('components.layouts.admin', ['title' => 'Users']);
    }

}
