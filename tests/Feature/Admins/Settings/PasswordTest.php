<?php

namespace Tests\Feature\Livewire\Admins\Settings;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-setting
 * @group admin-setting-password
 */
class PasswordTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Enable Livewire testing with routes
        config(['admin.prefix' => 'admins']);
    }

    public function test_admin_can_view_password_settings_component()
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin')
            ->get(route('admins.settings.password'))
            ->assertStatus(200)
            ->assertSee('Update password');
    }

    public function test_password_update_fails_with_invalid_current_password()
    {
        $admin = Admin::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        Livewire::actingAs($admin, 'admin')
            ->test('admins.settings.password')
            ->set('current_password', 'wrong-password')
            ->set('password', 'newpassword123')
            ->set('password_confirmation', 'newpassword123')
            ->call('updatePassword')
            ->assertHasErrors(['current_password']);
    }

    public function test_password_update_succeeds_with_valid_input()
    {
        $admin = Admin::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        Livewire::actingAs($admin, 'admin')
            ->test('admins.settings.password')
            ->set('current_password', 'secret123')
            ->set('password', 'newpassword123')
            ->set('password_confirmation', 'newpassword123')
            ->call('updatePassword')
            ->assertDispatched('password-updated')
            ->assertHasNoErrors();

        $this->assertTrue(Hash::check('newpassword123', $admin->fresh()->password));
    }

    public function test_password_update_fails_if_passwords_do_not_match()
    {
        $admin = Admin::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        Livewire::actingAs($admin, 'admin')
            ->test('admins.settings.password')
            ->set('current_password', 'secret123')
            ->set('password', 'newpassword123')
            ->set('password_confirmation', 'differentpassword')
            ->call('updatePassword')
            ->assertHasErrors(['password']);
    }
}
