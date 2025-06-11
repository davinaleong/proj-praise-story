<?php

namespace Tests\Feature\Livewire\Admins\Users\Testimonies;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-user
 * @group admin-user-testimony
 * @group admin-user-testimony-index
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_user_testimonies_index_page()
    {
        // Arrange: Create admin, user, and testimonies
        $admin = Admin::factory()->create();
        $user = User::factory()->create();
        $testimonies = Testimony::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        // Act: Visit route as admin
        $this->actingAs($admin, 'admin')
            ->get(route('admins.users.testimonies.index', ['uuid' => $user->uuid]))
            ->assertOk()
            ->assertSee('Users - Testimonies')
            ->assertSee($testimonies->first()->title);
    }

    public function test_guest_cannot_access_user_testimonies_index_page()
    {
        $user = User::factory()->create();

        $this->get(route('admins.users.testimonies.index', ['uuid' => $user->uuid]))
            ->assertRedirect(route('me.login'));
    }

    public function test_component_renders_correctly()
    {
        $admin = Admin::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test(\App\Livewire\Admins\Users\Testimonies\Index::class, ['uuid' => $user->uuid])
            ->assertStatus(200)
            ->assertViewHas('testimonies');
    }
}
