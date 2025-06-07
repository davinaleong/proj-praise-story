<?php

namespace App\Livewire\Admins\Messages;

use App\Models\Message;
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
        $messages = Message::with(['user', 'admin', 'context'])
            ->when($this->search, fn ($query) =>
                $query->where('subject', 'like', "%{$this->search}%")
                      ->orWhereHas('user', fn ($q) =>
                          $q->where('name', 'like', "%{$this->search}%")
                      )
            )
            ->latest('sent_at')
            ->paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.admins.messages.index', [
            'messages' => $messages,
        ])->layout('components.layouts.admin', [
            'title' => 'Messages',
        ]);
    }
}
