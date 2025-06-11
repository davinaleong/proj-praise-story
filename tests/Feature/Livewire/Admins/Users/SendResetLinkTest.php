<?php

namespace Tests\Feature\Livewire\Admins\Users;

use App\Livewire\Admins\Users\SendResetLink;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-user
 * @group admin-user-reset-password
 */
class SendResetLinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_render_reset_link_page_for_user()
    {
        $admin = Admin::factory()->create();
        $target = User::factory()->create();

        $this->actingAs($admin, 'admin')
            ->get(route('admins.users.send-reset-link', $target->uuid))
            ->assertStatus(200)
            ->assertSee("Send a password reset email to the selected user");
    }

    public function test_admin_can_send_reset_link_to_user()
    {
        Notification::fake();

        $admin = Admin::factory()->create();
        $target = User::factory()->create();

        Livewire::actingAs($admin, 'admin')
            ->test(SendResetLink::class, ['uuid' => $target->uuid])
            ->call('sendResetLink')
            ->assertDispatched('reset-link-sent')
            ->assertSee("A password reset link has been sent to {$target->email}.");

        Notification::assertSentTo($target, ResetPassword::class);
    }

    public function test_error_is_set_if_reset_link_fails()
    {
        // Override the user's email to one that will fail (simulate logic error)
        $admin = Admin::factory()->create();
        $user = User::factory()->create();

        // Simulate failure response
        \Illuminate\Support\Facades\Password::shouldReceive('sendResetLink')
            ->once()
            ->with(['email' => $user->email])
            ->andReturn(\Illuminate\Support\Facades\Password::INVALID_USER);

        // Optionally mock Password::sendResetLink to return a failure
        Livewire::actingAs($admin, 'admin')
            ->test(SendResetLink::class, ['uuid' => $user->uuid])
            ->call('sendResetLink')
            ->assertHasErrors(['statusMessage']);
    }
}
