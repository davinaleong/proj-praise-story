<?php

namespace App\Livewire\Admins\ContactMessages;

use App\Models\Contact;
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
        $contacts = Contact::query()
            ->when($this->search, fn ($query) =>
                $query->where('email', 'like', "%{$this->search}%")
                      ->orWhere('subject', 'like', "%{$this->search}%")
                      ->orWhere('message', 'like', "%{$this->search}%")
            )
            ->latest()
            ->paginate(Setting::ITEMS_PER_PAGE_100);

        return view('livewire.admins.contact-messages.index', [
            'contacts' => $contacts,
        ])->layout('components.layouts.admin', [
            'title' => 'Contact Messages',
        ]);
    }
}
