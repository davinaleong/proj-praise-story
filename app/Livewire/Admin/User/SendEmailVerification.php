<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Livewire\Component;

class SendEmailVerification extends Component
{
    public User $user;
    public string $statusMessage = '';

    public function mount(string $uuid)
    {
        $this->user = User::where('uuid', $uuid)
            ->firstOrFail();

        session()->put('user', $this->user);
    }

    public function sendVerificationEmail()
    {
        if ($this->user->hasVerifiedEmail()) {
            $this->statusMessage = 'User is already verified.';
            return;
        }

        $this->user->sendEmailVerificationNotification();

        $this->dispatch('verification-link-sent');
        $this->statusMessage = 'Verification link sent to ' . $this->user->email;
    }

    public function render()
    {
        return view('livewire.admins.users.send-email-verification', [
                'title' => 'Users - Send Email Verification',
                'user' => $this->user,
                'heading' => 'Users - Send Email Verification',
                'subheading' => 'Manually trigger a verification email for users who haven\'t verified their email address.',
            ])
            ->layout('components.layouts.admin', ['title' => 'Users - Send Email Verification']);
    }
}
