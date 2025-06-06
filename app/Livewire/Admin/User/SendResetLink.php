<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class SendResetLink extends Component
{
    public User $user;
    public string $statusMessage = '';

    public function mount(string $uuid)
    {
        $this->user = User::where('uuid', $uuid)
            ->firstOrFail();

        session()->put('user', $this->user);
    }

    public function sendResetLink(): void
    {
        $this->reset('statusMessage');

        $status = Password::sendResetLink(['email' => $this->user->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->statusMessage = __('A password reset link has been sent to :email.', [
                'email' => $this->user->email,
            ]);

            $this->dispatch('reset-link-sent');
        } else {
            $this->addError('statusMessage', __('Failed to send reset link. Please try again later.'));
        }

    }


    public function render()
    {
        return view('livewire.admins.users.send-reset-link', [
                'title' => 'Users - Send Reset Link',
                'user' => $this->user,
                'heading' => 'Users - Send Reset Link',
                'subheading' => 'Send a password reset email to the selected user. This action does not change their password directly.',
            ])
            ->layout('components.layouts.admin', ['title' => 'Users - Send Reset Link']);
    }
}

