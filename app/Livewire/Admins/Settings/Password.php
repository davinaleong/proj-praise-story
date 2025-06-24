<?php

namespace App\Livewire\Admins\Settings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Password extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated admin.
     */
    public function updatePassword(): void
    {
        $admin = Auth::guard('admin')->user();

        // Manually check the current password since current_password rule defaults to the 'web' guard
        if (!Hash::check($this->current_password, $admin->password)) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw ValidationException::withMessages([
                'current_password' => __('The provided password does not match your current password.'),
            ]);
        }

        $validated = $this->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', PasswordRule::defaults(), 'confirmed'],
        ]);

        $admin->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }

    public function render()
    {
        return view('livewire.admins.settings.password')
            ->layout('components.layouts.admin', ['title' => 'Password Settings']);
    }
}
