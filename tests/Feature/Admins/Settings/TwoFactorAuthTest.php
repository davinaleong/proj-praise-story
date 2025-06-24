<?php

namespace Tests\Feature\Admins\Settings;

use App\Livewire\Admins\Settings\TwoFactorAuth;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group feature
 * @group admin
 * @group settings
 * @group admin-two-factor-auth
 */
class TwoFactorAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['auth.defaults.guard' => 'admin']);
    }

    public function test_admin_can_enable_two_factor_authentication()
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::actingAs($admin, 'admin')
            ->test(TwoFactorAuth::class)
            ->call('enable')
            ->assertDispatched('2fa-enabled');

        $admin->refresh();

        $this->assertNotNull($admin->two_factor_secret);
        $this->assertNotNull($admin->two_factor_recovery_codes);
    }

    public function test_admin_can_regenerate_recovery_codes()
    {
        $admin = Admin::factory()->create([
            'two_factor_secret' => encrypt('SOME_SECRET_KEY'),
            'two_factor_recovery_codes' => encrypt(['old-code']),
        ]);

        $this->actingAs($admin, 'admin');

        Livewire::actingAs($admin, 'admin')
            ->test(TwoFactorAuth::class)
            ->call('regenerateRecoveryCodes')
            ->assertDispatched('recovery-codes-regenerated');

        $admin->refresh();

        $codes = decrypt($admin->two_factor_recovery_codes);

        $this->assertIsArray($codes);
        $this->assertCount(8, $codes);
        $this->assertNotContains('old-code', $codes);
    }

    public function test_admin_can_disable_two_factor_authentication()
    {
        $admin = Admin::factory()->create([
            'two_factor_secret' => encrypt('SOME_SECRET_KEY'),
            'two_factor_recovery_codes' => encrypt(['some-code']),
        ]);

        $this->actingAs($admin, 'admin');

        Livewire::actingAs($admin, 'admin')
            ->test(TwoFactorAuth::class)
            ->call('disable')
            ->assertDispatched('2fa-disabled');

        $admin->refresh();

        $this->assertNull($admin->two_factor_secret);
        $this->assertNull($admin->two_factor_recovery_codes);
    }
}
