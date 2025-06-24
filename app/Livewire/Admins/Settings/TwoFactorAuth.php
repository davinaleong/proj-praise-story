<?php

namespace App\Livewire\Admins\Settings;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Livewire\Component;
use Illuminate\Support\Collection;
use Laravel\Fortify\RecoveryCode;

class TwoFactorAuth extends Component
{
    public array $recoveryCodes = [];

    public function enable()
    {
        app(EnableTwoFactorAuthentication::class)(Auth::guard('admin')->user()
);
        $this->loadRecoveryCodes();
        $this->dispatch('2fa-enabled');
    }

    public function disable()
    {
        app(DisableTwoFactorAuthentication::class)(Auth::guard('admin')->user()
);
        $this->recoveryCodes = [];
        $this->dispatch('2fa-disabled');
    }

    public function regenerateRecoveryCodes()
    {
        Auth::guard('admin')->user()
->forceFill([
            'two_factor_recovery_codes' => encrypt(Collection::times(8, fn () => RecoveryCode::generate())->all()),
        ])->save();

        $this->loadRecoveryCodes();
        $this->dispatch('recovery-codes-regenerated');
    }

    public function loadRecoveryCodes()
    {
//         $this->recoveryCodes = json_decode(decrypt(Auth::guard('admin')->user()
// ->two_factor_recovery_codes));

        $encrypted = Auth::guard('admin')->user()
->two_factor_recovery_codes;

        if (! $encrypted) {
            $this->recoveryCodes = [];
            return;
        }

        $decrypted = decrypt($encrypted);

        // No need to json_decode — decrypted value is already an array
        $this->recoveryCodes = is_array($decrypted) ? $decrypted : [];
    }

    public function render()
    {
        return view('livewire.settings.two-factor-auth', [
            'user' => Auth::guard('admin')->user()
,
        ])
            ->layout('components.layouts.admin', ['title' => 'Profile Settings']);;
    }
}
