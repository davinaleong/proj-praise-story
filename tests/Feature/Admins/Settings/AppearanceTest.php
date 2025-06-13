<?php

namespace Tests\Feature\Admins\Settings;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Livewire\Admins\Settings\Appearance;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-setting
 * @group admin-setting-appearance
 */
class AppearanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_appearance_settings_page(): void
    {
        $this->get(route('admins.settings.appearance'))
            ->assertRedirect(route('me.login'));
    }

    public function test_admin_can_view_appearance_settings_component(): void
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin')
            ->get(route('admins.settings.appearance'))
            ->assertOk()
            ->assertSee('Appearance Settings')
            ->assertSee('Update the appearance settings for the admin account')
            ->assertSee('Light')
            ->assertSee('Dark')
            ->assertSee('System');
    }

    public function test_appearance_component_renders_successfully(): void
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test(Appearance::class)
            ->assertStatus(200);
    }
}
