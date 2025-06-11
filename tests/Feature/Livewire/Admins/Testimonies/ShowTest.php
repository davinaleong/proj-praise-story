<?php

namespace Tests\Feature\Livewire\Admins\Testimonies;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-testimony
 * @group admin-testimony-show
 */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_single_testimony()
    {
        // Create admin from Admin model
        $admin = Admin::factory()->create();

        // Create a testimony
        $testimony = Testimony::factory()->create([
            'uuid' => (string) Str::uuid(),
            'title' => 'Jesus saved me',
            'content' => 'This is my story of grace.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        // Acting as admin using the 'admin' guard
        $response = $this->actingAs($admin, 'admin')
            ->get(route('admins.testimonies.show', $testimony->uuid));

        // Assert success
        $response->assertOk();
        $response->assertSeeText('Jesus saved me');
        $response->assertSeeText('This is my story of grace.');
        $response->assertSeeText('Published');
    }

    public function test_guest_cannot_view_testimony()
    {
        $testimony = Testimony::factory()->create([
            'uuid' => (string) Str::uuid(),
        ]);

        $response = $this->get(route('admins.testimonies.show', $testimony->uuid));

        $response->assertRedirect(route('me.login'));
    }
}
