<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactConfirmation;
use App\Models\Contact as ContactModel;
use App\Rules\NoProfanity;

class Contact extends Component
{
    public string $email = '';
    public string $message = '';
    public string $honeypot = '';

    public function submit()
    {
        if ($this->honeypot !== '') {
            return; // Spam detected
        }

        $this->validate([
            'email' => ['required', 'email', new NoProfanity],
            'message' => ['required', 'min:10', new NoProfanity],
        ]);

        ContactModel::create([
            'subject' => 'We received your message',
            'email' => $this->email,
            'message' => $this->message,
        ]);

        // Send confirmation email to sender
        Mail::to($this->email)->send(new ContactConfirmation($this->email, $this->message));

        session()->flash('success', 'Thank you! Your message has been sent.');
        $this->reset(['email', 'message']);
    }

    public function render()
    {
        return view('livewire.contact')
            ->layout('components.layouts.auth');
    }
}

