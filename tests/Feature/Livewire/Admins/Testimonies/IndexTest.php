<?php

namespace Tests\Feature\Livewire\Admins\Testimonies;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-testimony
 * @group admin-testimony-index
 */
class IndexTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_admin_can_view_all_testimonies_index_page(): void
    {
        // Create an admin user and authenticate
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a few testimonies
        Testimony::factory()->count(3)->create();

        // Hit the Livewire component route
        $response = $this->get(route('admins.testimonies.index'));

        $response->assertOk();
        $response->assertSee('All Testimonies');

        // Confirm a known testimony is listed
        $testimony = Testimony::first();
        $response->assertSee($testimony->title);
    }

    public function test_guest_cannot_access_testimonies_index(): void
    {
        $response = $this->get(route('admins.testimonies.index'));
        $response->assertRedirect(route('me.login'));
    }
}
