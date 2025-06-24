<?php

namespace Tests\Feature\Admins\Auth;

use App\Livewire\Admins\Auth\TwoFactorChallenge;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PragmaRX\Google2FA\Google2FA;
use Tests\TestCase;

/**
 * @group feature
 * @group admins
 * @group admin-two-factor
 * @group admin-two-factor-challenge
 */
class TwoFactorChallengeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['auth.defaults.guard' => 'admin']);
    }

    public function test_it_redirects_if_admin_session_missing()
    {
        $response = $this->get(route('admins.two-factor-challenge'));

        $response->assertRedirect(route('admins.login'));
    }

    public function test_it_allows_login_with_valid_2fa_code()
    {
        $google2fa = new Google2FA();
        $secret = $google2fa->generateSecretKey();
        $otp = $google2fa->getCurrentOtp($secret);

        $admin = Admin::factory()->create([
            'two_factor_secret' => encrypt($secret),
        ]);

        session([
            'admin.2fa:id' => $admin->id,
            'admin.2fa:remember' => false,
        ]);

        Livewire::test(TwoFactorChallenge::class)
            ->set('code', $otp)
            ->call('authenticate')
            ->assertRedirect(route('admins.dashboard'));

        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_it_allows_login_with_valid_recovery_code()
    {
        $codes = ['code-1', 'code-2'];

        $admin = Admin::factory()->create([
            'two_factor_secret' => encrypt('dummy-secret'),
            'two_factor_recovery_codes' => encrypt($codes),
        ]);

        session([
            'admin.2fa:id' => $admin->id,
            'admin.2fa:remember' => true,
        ]);

        Livewire::test(TwoFactorChallenge::class)
            ->set('recovery_code', 'code-1')
            ->call('authenticate')
            ->assertRedirect(route('admins.dashboard'));

        $admin->refresh();
        $newCodes = json_decode(decrypt($admin->two_factor_recovery_codes), true);

        $this->assertNotContains('code-1', $newCodes);
        $this->assertContains('code-2', $newCodes);
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_it_rejects_invalid_otp_code()
    {
        $secret = (new Google2FA())->generateSecretKey();

        $admin = Admin::factory()->create([
            'two_factor_secret' => encrypt($secret),
        ]);

        session(['admin.2fa:id' => $admin->id]);

        Livewire::test(TwoFactorChallenge::class)
            ->set('code', '123456') // wrong code
            ->call('authenticate')
            ->assertHasErrors('code');

        $this->assertGuest('admin');
    }

    public function test_it_rejects_invalid_recovery_code()
    {
        $admin = Admin::factory()->create([
            'two_factor_secret' => encrypt('secret'),
            'two_factor_recovery_codes' => encrypt(['code-1']),
        ]);

        session(['admin.2fa:id' => $admin->id]);

        Livewire::test(TwoFactorChallenge::class)
            ->set('recovery_code', 'wrong-code')
            ->call('authenticate')
            ->assertHasErrors('code');

        $this->assertGuest('admin');
    }
}
