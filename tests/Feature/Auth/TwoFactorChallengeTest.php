<?php

namespace Tests\Feature\Auth;

use App\Livewire\Auth\TwoFactorChallenge;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PragmaRX\Google2FA\Google2FA;
use Tests\TestCase;

/**
 * @group feature
 * @group auth
 * @group two-factor-challenge
 */
class TwoFactorChallengeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_redirects_if_user_session_missing()
    {
        $response = $this->get(route('me.two-factor-challenge'));

        $response->assertRedirect(route('login'));
    }

    public function test_it_allows_login_with_valid_2fa_code()
    {
        $google2fa = new Google2FA();
        $secret = $google2fa->generateSecretKey();
        $otp = $google2fa->getCurrentOtp($secret);

        $user = User::factory()->create([
            'two_factor_secret' => encrypt($secret),
        ]);

        session([
            'login.id' => $user->id,
            'login.remember' => false,
        ]);

        Livewire::test(TwoFactorChallenge::class)
            ->set('code', $otp)
            ->call('authenticate')
            ->assertRedirect(route('private.testimonies.index'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_it_allows_login_with_valid_recovery_code()
    {
        $codes = ['code-1', 'code-2'];

        $user = User::factory()->create([
            'two_factor_secret' => encrypt('dummy-secret'),
            'two_factor_recovery_codes' => encrypt($codes),
        ]);

        session([
            'login.id' => $user->id,
            'login.remember' => true,
        ]);

        Livewire::test(TwoFactorChallenge::class)
            ->set('recovery_code', 'code-1')
            ->call('authenticate')
            ->assertRedirect(route('private.testimonies.index'));

        $user->refresh();
        $newCodes = decrypt($user->two_factor_recovery_codes);

        $this->assertNotContains('code-1', $newCodes);
        $this->assertContains('code-2', $newCodes);
        $this->assertAuthenticatedAs($user);
    }

    public function test_it_rejects_invalid_otp_code()
    {
        $secret = (new Google2FA())->generateSecretKey();

        $user = User::factory()->create([
            'two_factor_secret' => encrypt($secret),
        ]);

        session(['login.id' => $user->id]);

        Livewire::test(TwoFactorChallenge::class)
            ->set('code', '123456') // wrong
            ->call('authenticate')
            ->assertHasErrors('code');

        $this->assertGuest();
    }

    public function test_it_rejects_invalid_recovery_code()
    {
        $user = User::factory()->create([
            'two_factor_secret' => encrypt('any'),
            'two_factor_recovery_codes' => encrypt(['code-1']),
        ]);

        session(['login.id' => $user->id]);

        Livewire::test(TwoFactorChallenge::class)
            ->set('recovery_code', 'wrong-code')
            ->call('authenticate')
            ->assertHasErrors('recovery_code');

        $this->assertGuest();
    }
}
