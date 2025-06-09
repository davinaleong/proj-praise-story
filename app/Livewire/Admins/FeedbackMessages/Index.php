<?php

namespace App\Livewire\Admins\FeedbackMessages;

use App\Models\Feedback;
use App\Helpers\Setting;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public int $perPage = 10;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $feedback = Feedback::query()
            ->when($this->search, fn ($query) =>
                $query->where('message', 'like', "%{$this->search}%")
            )
            ->latest()
            ->paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.admins.feedback-messages.index', [
            'feedback' => $feedback,
        ])->layout('components.layouts.admin', [
            'title' => 'Feedback Messages',
        ]);
    }
}
