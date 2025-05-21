<?php

namespace App\Livewire\Contact;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotification;
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

        Mail::to($this->email)->send(new ContactNotification(
            $this->subject, $this->email,$this->message));

        session()->flash('message', 'Thanks for your message!');
        $this->reset(['subject', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.contact.show');
    }
}
