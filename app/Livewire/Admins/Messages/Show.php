<?php

namespace App\Livewire\Admins\Messages;

use App\Models\Message;
use Livewire\Component;

class Show extends Component
{
    public Message $message;

    public function mount(string $uuid): void
    {
        $this->message = Message::where('uuid', $uuid)->with(['user', 'admin', 'context'])->firstOrFail();
    }

    public function render()
    {
        return view('livewire.admins.messages.show', [
            'message' => $this->message,
        ])->layout('components.layouts.admin', [
            'title' => 'Message Details',
        ]);
    }
}
