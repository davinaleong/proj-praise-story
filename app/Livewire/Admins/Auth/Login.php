<?php

namespace App\Livewire\Admins\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Admin;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // First check if credentials match an admin
        if (Auth::guard('admin')->once($credentials)) {
            $admin = Auth::guard('admin')->user();

            if ($admin->two_factor_secret) {
                // Store admin ID and remember flag in session for 2FA
                session()->put('admin.2fa:id', $admin->getKey());
                session()->put('admin.2fa:remember', $this->remember);

                // Log out any temporary login
                Auth::guard('admin')->logout();

                return redirect()->route('admins.two-factor-challenge');
            }

            // No 2FA enabled, proceed to log in
            Auth::guard('admin')->attempt($credentials, $this->remember);
            session()->regenerate();

            return redirect()->route('admins.dashboard');
        }

        $this->addError('email', 'Invalid login credentials.');
    }

    public function render()
    {
        return view('livewire.admins.auth.login')
            ->layout('components.layouts.auth');
    }
}
