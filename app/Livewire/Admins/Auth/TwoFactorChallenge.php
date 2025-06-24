<?php

namespace App\Livewire\Admins\Auth;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorChallenge extends Component
{
    public string $code = '';
    public string $recovery_code = '';

    public function mount()
    {
        if (!session()->has('admin.2fa:id')) {
            return redirect()->route('admins.login');
        }

        $admin = Admin::find(session('admin.2fa:id'));

        if (!$admin || !$admin->two_factor_secret) {
            session()->forget(['admin.2fa:id', 'admin.2fa:remember']);
            return redirect()->route('admins.login');
        }
    }

    public function authenticate()
    {
        $adminId = session('admin.2fa:id');
        $remember = session('admin.2fa:remember', false);

        if (!$adminId) {
            return redirect()->route('admins.login'); // session expired or invalid
        }

        $admin = Admin::find($adminId);

        if (!$admin || !$admin->two_factor_secret) {
            return redirect()->route('admins.login');
        }

        if ($this->code && app(\PragmaRX\Google2FA\Google2FA::class)->verifyKey(decrypt($admin->two_factor_secret), $this->code)) {
            // Log in
            Auth::guard('admin')->loginUsingId($admin->id, $remember);
            session()->regenerate();

            // Clear 2FA session data
            session()->forget(['admin.2fa:id', 'admin.2fa:remember']);

            return redirect()->route('admins.dashboard');
        }

        if ($this->recovery_code && $admin->hasValidRecoveryCode($this->recovery_code)) {
            $admin->replaceRecoveryCode($this->recovery_code);
            Auth::guard('admin')->loginUsingId($admin->id, $remember);
            session()->regenerate();
            session()->forget(['admin.2fa:id', 'admin.2fa:remember']);

            return redirect()->route('admins.dashboard');
        }

        $this->addError('code', __('The provided code was invalid.'));
    }


    public function render()
    {
        return view('livewire.admins.auth.two-factor-challenge')
            ->layout('components.layouts.auth');
    }
}
