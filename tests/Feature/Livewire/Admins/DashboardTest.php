<?php

namespace Tests\Feature\Livewire\Admins;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group feature
 * @group admin
 * @group admin-dashboard
 */
class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_requires_authentication()
    {
        $response = $this->get(route('admins.dashboard'));
        $response->assertRedirect(route('me.login'));
    }

    public function test_authenticated_admin_can_see_dashboard_component()
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test(\App\Livewire\Admins\Dashboard::class)
            ->assertStatus(200)
            ->assertSee('Dashboard')
            ->assertSee('Manage Users')
            ->assertSee('Manage Testimonies')
            ->assertSee('Manage Contact Messages')
            ->assertSee('Manage Feedback Messages');
    }

    public function test_dashboard_view_renders_correct_links()
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admins.dashboard'));

        $response->assertOk();
        $response->assertSee(route('admins.users.index'), false);
        $response->assertSee(route('admins.testimonies.index'), false);
        $response->assertSee(route('admins.contact-messages.index'), false);
        $response->assertSee(route('admins.feedback-messages.index'), false);
    }
}
