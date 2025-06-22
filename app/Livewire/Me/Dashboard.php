<?php

namespace App\Livewire\Me;

use Livewire\Component;
use App\Models\Testimony;
use App\Helpers\Status;

class Dashboard extends Component
{
    public $testimonies = [];
    public $counts = [];

    public $readyToLoad = false;

    public function loadTestimonies()
    {
        $this->readyToLoad = true;

        $user = auth()->user();
        $this->testimonies = $user->testimonies()
            ->with('likes')
            ->latest('published_at')
            ->get();

        $this->counts = [
            'public' => $this->testimonies->where('status', Status::STATUS_TESTIMONY_PUBLIC)->count(),
            'private' => $this->testimonies->where('status', Status::STATUS_TESTIMONY_PRIVATE)->count(),
            'published' => $this->testimonies->where('status', Status::STATUS_TESTIMONY_PUBLISHED)->count(),
        ];
    }

    public function render()
    {
        return view('livewire.me.dashboard')
            ->layout('components.layouts.me', ['title' => 'Dashboard']);
    }
}
