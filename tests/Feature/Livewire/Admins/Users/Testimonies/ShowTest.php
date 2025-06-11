<?php

namespace Tests\Feature\Livewire\Admins\Users\Testimonies;

use App\Models\Admin;
use App\Models\User;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-user
 * @group admin-user-testimony
 * @group admin-user-testimony-show
 */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_user_testimony_show_page(): void
    {
        $admin = Admin::factory()->create();
        $user = User::factory()->create();
        $testimony = Testimony::factory()->for($user)->create([
            'title' => 'Testimony Title',
            'content' => 'This is the **testimony** content.',
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admins.users.testimonies.show', [
                'uuid' => $user->uuid,
                'testimony_uuid' => $testimony->uuid,
            ]))
            ->assertOk()
            ->assertSee('Testimony Title')
            ->assertSee('Written by');
    }

    public function test_guest_cannot_view_user_testimony_show_page(): void
    {
        $user = User::factory()->create();
        $testimony = Testimony::factory()->for($user)->create();

        $this->get(route('admins.users.testimonies.show', [
            'uuid' => $user->uuid,
            'testimony_uuid' => $testimony->uuid,
        ]))->assertRedirect(route('me.login'));
    }
}
