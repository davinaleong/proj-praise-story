<?php

namespace App\Livewire\Auth;

use App\Models\User;
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
        $userId = session('login.id');

        if (! $userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);

        if (! $user || ! $user->two_factor_secret) {
            Session::forget(['login.id', 'login.remember']);
            return redirect()->route('login');
        }
    }

    public function authenticate()
    {
        $this->resetErrorBag();

        $userId = session('login.id');

        if (! $userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);

        if (! $user) {
            return redirect()->route('login');
        }

        // Try 2FA code
        if ($this->code) {
            $google2fa = new Google2FA();

            if (! $google2fa->verifyKey(decrypt($user->two_factor_secret), $this->code)) {
                throw ValidationException::withMessages([
                    'code' => __('The provided authentication code is invalid.'),
                ]);
            }
        }
        // Try recovery code
        elseif ($this->recovery_code) {
            $codes = json_decode(decrypt($user->two_factor_recovery_codes ?? '[]'), true);

            if (! in_array($this->recovery_code, $codes)) {
                throw ValidationException::withMessages([
                    'recovery_code' => __('The recovery code is invalid.'),
                ]);
            }

            // Remove used recovery code
            $user->two_factor_recovery_codes = encrypt(array_values(array_diff($codes, [$this->recovery_code])));
            $user->save();
        }
        else {
            throw ValidationException::withMessages([
                'code' => __('Please enter a valid authentication or recovery code.'),
            ]);
        }

        // Successful authentication
        Auth::login($user, session('login.remember', false));
        Session::forget(['login.id', 'login.remember']);

        return redirect()->intended(route('private.testimonies.index'));
    }

    public function render()
    {
        return view('livewire.auth.two-factor-challenge')
            ->layout('components.layouts.auth', ['title' => 'Two-Factor Authentication']);
    }
}
