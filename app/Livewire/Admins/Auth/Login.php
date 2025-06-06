<?php

namespace App\Livewire\Admins\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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

        if (Auth::guard('admin')->attempt($credentials, $this->remember)) {
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
