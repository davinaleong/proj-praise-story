<?php

namespace App\Livewire\Me;

use Livewire\Component;
use App\Models\Testimony;
use App\Helpers\Status;

class Dashboard extends Component
{
    public $testimonies;
    public $counts = [];

    public function mount()
    {
        $user = auth()->user();

        $this->testimonies = $user->testimonies()
            ->latest('published_at')
            ->get();

        $this->counts = [
            'public' => $this->testimonies->where('status', Status::STATUS_TESTIMONY_PUBLIC)->count(),
            'private' => $this->testimonies->where('status', Status::STATUS_TESTIMONY_PRIVATE)->count(),
            'published' => $this->testimonies->whereIn('status', [
                Status::STATUS_TESTIMONY_PUBLIC,
                Status::STATUS_TESTIMONY_PRIVATE,
            ])->count(),
        ];
    }

    public function render()
    {
        return view('livewire.me.dashboard')
            ->layout('layouts.me', ['title' => 'Dashboard']);
    }
}
