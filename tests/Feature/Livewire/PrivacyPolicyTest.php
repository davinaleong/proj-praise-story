<?php

namespace Tests\Feature\Livewire;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group livewire
 * @group testimony
 * @group privacy-policy
 */
class PrivacyPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_public_privacy_policy()
    {
        $response = $this->get(route('privacy-policy.show'));

        $response->assertStatus(200)
                 ->assertSee('Privacy Policy')
                 ->assertSee('Your privacy is important to us.')
                 ->assertSee('1. Information We Collect');
    }

    public function test_authenticated_user_can_view_me_privacy_policy()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('me.privacy-policy'));

        $response->assertStatus(200)
                 ->assertSee('Privacy Policy')
                 ->assertSee('6. Your Rights');
    }

    public function test_guest_is_redirected_from_me_privacy_policy()
    {
        $response = $this->get(route('me.privacy-policy'));

        $response->assertRedirect('/me/login');
    }
}
