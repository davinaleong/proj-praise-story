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

        $this->statusMessage = $status === Password::RESET_LINK_SENT
            ? __('A reset link has been sent to :email', ['email' => $this->user->email])
            : __('Failed to send reset link.');
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

