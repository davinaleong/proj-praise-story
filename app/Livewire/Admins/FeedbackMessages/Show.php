<?php

namespace App\Livewire\Admins\FeedbackMessages;

use App\Models\Feedback;
use Livewire\Component;

class Show extends Component
{
    public Feedback $feedback;

    public function mount(string $uuid): void
    {
        $this->feedback = Feedback::where('uuid', $uuid)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.admins.feedback-messages.show', [
            'feedback' => $this->feedback,
        ])->layout('components.layouts.admin', [
            'title' => 'Feedback Message',
        ]);
    }
}
