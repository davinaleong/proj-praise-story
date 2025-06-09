<?php

namespace App\Livewire\Admins\Testimonies;

use App\Models\Testimony;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Setting;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $testimonies = Testimony::query()
            ->with(['user'])
            ->when($this->search, fn ($query) =>
                $query->where('title', 'like', "%{$this->search}%")
                      ->orWhereHas('user', fn ($q) =>
                          $q->where('name', 'like', "%{$this->search}%")
                      )
            )
            ->latest()
            ->paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.admins.testimonies.index', [
            'testimonies' => $testimonies,
        ])->layout('components.layouts.admin', [
            'title' => 'Testimonies',
        ]);
    }
}
