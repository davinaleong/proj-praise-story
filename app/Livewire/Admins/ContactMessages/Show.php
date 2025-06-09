<?php

namespace App\Livewire\Admins\ContactMessages;

use App\Models\Contact;
use Livewire\Component;

class Show extends Component
{
    public Contact $contact;

    public function mount(string $uuid): void
    {
        $this->contact = Contact::where('uuid', $uuid)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.admins.contact-messages.show', [
            'contact' => $this->contact,
        ])->layout('components.layouts.admin', [
            'title' => 'Contact Message',
        ]);
    }
}
