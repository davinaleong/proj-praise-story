<?php

namespace Tests\Feature\Livewire\User;

use App\Livewire\Settings\TwoFactorAuth;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group feature
 * @group livewire
 * @group user
 * @group user-2fa
 */
class TwoFactorAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_enable_two_factor_authentication()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(TwoFactorAuth::class)
            ->call('enable')
            ->assertDispatched('2fa-enabled');

        $user->refresh();

        $this->assertNotNull($user->two_factor_secret);
        $this->assertNotNull($user->two_factor_recovery_codes);
    }

    public function test_user_can_regenerate_recovery_codes()
    {
        $user = User::factory()->create([
            'two_factor_secret' => encrypt('SOME_SECRET_KEY'),
            'two_factor_recovery_codes' => encrypt(['old-code']), // ✅ encrypted array directly
        ]);

        $this->actingAs($user);

        Livewire::test(TwoFactorAuth::class)
            ->call('regenerateRecoveryCodes')
            ->assertDispatched('recovery-codes-regenerated');

        $user->refresh();

        $codes = decrypt($user->two_factor_recovery_codes); // ✅ decrypted array, no json_decode

        $this->assertIsArray($codes);
        $this->assertCount(8, $codes);
        $this->assertNotContains('old-code', $codes);
    }

    public function test_user_can_disable_two_factor_authentication()
    {
        $user = User::factory()->create([
            'two_factor_secret' => encrypt('SOME_SECRET_KEY'),
            'two_factor_recovery_codes' => encrypt(json_encode(['some-code'])),
        ]);

        $this->actingAs($user);

        Livewire::test(TwoFactorAuth::class)
            ->call('disable')
            ->assertDispatched('2fa-disabled');

        $user->refresh();

        $this->assertNull($user->two_factor_secret);
        $this->assertNull($user->two_factor_recovery_codes);
    }

}
