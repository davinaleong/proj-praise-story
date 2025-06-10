<?php

namespace Tests\Feature\Livewire\Admins\Users;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-user
 * @group admin-user-show
 */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_user_profile()
    {
        // Arrange: create a user with UUID
        $user = User::factory()->create();

        // Act & Assert: load the component directly via Livewire
        Livewire::test('admins.users.show', ['uuid' => $user->uuid])
            ->assertViewHas('user', $user)
            ->assertSee($user->uuid)
            ->assertSee($user->name)
            ->assertSee($user->email)
            ->assertSee(optional($user->email_verified_at)->format('d-m-Y H:i') ?? 'Not Verified')
            ->assertSee($user->created_at->format('d-m-Y H:i'));
    }
}
