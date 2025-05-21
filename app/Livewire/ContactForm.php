<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormNotification;

class ContactForm extends Component
{
    public string $subject = '';
    public string $email = '';
    public string $message = '';
    public string $honeypot = '';

    public function submit()
    {
        if ($this->honeypot) return; // simple spam check

        $validated = $this->validate([
            'subject' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        // Send confirmation/notification email
        Mail::to($validated['email'])->send(new ContactFormNotification(
            $validated['subject'],
            $validated['email'],
            $validated['message']
        ));

        session()->flash('message', 'Thank you for your feedback!');
        $this->reset(['subject', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}

