<?php

namespace Tests\Feature\Livewire\Admins\Users;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-user
 * @group admin-user-email-verification
 */
class SendEmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_renders_for_admin_user()
    {
        $admin = Admin::factory()->create();
        $user = User::factory()->unverified()->create();

        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admins.users.send-verification-link', $user->uuid));

        $response->assertStatus(200);
        $response->assertSee($user->email);
    }

    public function test_sends_verification_email_if_not_verified()
    {
        Notification::fake();

        $admin = Admin::factory()->create();
        $user = User::factory()->unverified()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.users.send-email-verification', ['uuid' => $user->uuid])
            ->call('sendVerificationEmail')
            ->assertDispatched('verification-link-sent')
            ->assertSet('statusMessage', 'Verification link sent to ' . $user->email);

        Notification::assertSentTo($user, \Illuminate\Auth\Notifications\VerifyEmail::class);
    }

    public function test_does_not_send_email_if_already_verified()
    {
        Notification::fake();

        $admin = Admin::factory()->create();
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.users.send-email-verification', ['uuid' => $user->uuid])
            ->call('sendVerificationEmail')
            ->assertSet('statusMessage', 'User is already verified.');

        Notification::assertNothingSent();
    }
}
