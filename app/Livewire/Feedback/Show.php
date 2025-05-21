<?php

namespace App\Livewire\Feedback;

use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackNotification;
use Livewire\Component;

class Show extends Component
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
            $this->subject, $this->email,$this->message));

        session()->flash('message', 'Thanks for your feedback!');
        $this->reset(['subject', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.feedback.show');
    }
}
