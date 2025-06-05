<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Setting;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.admins.users.index', ['users' => $users])
            ->layout('components.layouts.admins', ['title' => 'Users']);
    }

}
