<?php

namespace App\Livewire\Feedback;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackNotification;

class Me extends Component
{
    public $subject, $email, $message, $honeypot;

    public function submit()
    {
        if ($this->honeypot) return;

        $this->validate([
            'subject' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Mail::to($this->email)->send(new FeedbackNotification(
            $this->subject, $this->email, $this->message));

        session()->flash('message', 'Your feedback has been sent.');
        $this->reset(['subject', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.me.feedback-form');
    }
}
