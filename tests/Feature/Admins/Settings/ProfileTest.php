<?php

namespace Tests\Feature\Admins\Settings;

use App\Livewire\Admins\Settings\Profile;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-setting
 * @group admin-setting-profile
 */
class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Use default admin guard for authentication
        config(['auth.guards.admin.provider' => 'admins']);
    }

    public function test_admin_can_view_profile_settings_page(): void
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        $this->get(route('admins.settings.profile'))
            ->assertOk()
            ->assertSeeLivewire(Profile::class);
    }

    public function test_profile_form_is_prefilled_with_admin_data(): void
    {
        $admin = Admin::factory()->create([
            'name' => 'Alice Admin',
            'email' => 'admin@example.com',
        ]);

        $this->actingAs($admin, 'admin');

        Livewire::test(Profile::class)
            ->assertSet('name', 'Alice Admin')
            ->assertSet('email', 'admin@example.com');
    }

    public function test_admin_can_update_profile_information(): void
    {
        $admin = Admin::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin, 'admin');

        Livewire::test(Profile::class)
            ->set('name', 'New Name')
            ->set('email', 'newadmin@example.com')
            ->call('updateProfileInformation')
            ->assertDispatched('profile-updated', name: 'New Name');

        $admin->refresh();

        $this->assertEquals('New Name', $admin->name);
        $this->assertEquals('newadmin@example.com', $admin->email);
        $this->assertNull($admin->email_verified_at); // email was changed
    }

    public function test_validation_errors_are_thrown_on_invalid_input(): void
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test(Profile::class)
            ->set('name', '')
            ->set('email', 'not-an-email')
            ->call('updateProfileInformation')
            ->assertHasErrors(['name' => 'required', 'email' => 'email']);
    }

    public function test_email_must_be_unique(): void
    {
        $admin1 = Admin::factory()->create(['email' => 'taken@example.com']);
        $admin2 = Admin::factory()->create();

        $this->actingAs($admin2, 'admin');

        Livewire::test(Profile::class)
            ->set('email', 'taken@example.com')
            ->call('updateProfileInformation')
            ->assertHasErrors(['email' => 'unique']);
    }
}
