<?php

namespace App\Livewire\Me;

use Livewire\Component;
use App\Models\Feedback;
use Illuminate\Support\Str;

class FeedbackForm extends Component
{
    public string $uuid;
    public ?int $rating = null;
    public ?string $message = null;
    public string $honeypot = ''; // Anti-spam

    public function mount(): void
    {
        $this->uuid = (string) Str::uuid();
    }

    public function submit(): void
    {
        // Spam check
        if (!empty($this->honeypot)) {
            return;
        }

        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string|max:1000',
        ]);

        Feedback::create([
            'uuid' => $this->uuid,
            'rating' => $this->rating,
            'message' => $this->message,
        ]);

        session()->flash('success', 'Thank you for your feedback!');
        $this->reset(['rating', 'message']);
        $this->uuid = (string) Str::uuid();
    }

    public function render()
    {
        return view('livewire.me.feedback-form')
            ->layout('components.layouts.me', ['title' => 'Dashboard']);
    }
}
