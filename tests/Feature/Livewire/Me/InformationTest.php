<?php

namespace Tests\Feature\Livewire\Me;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group livewire
 * @group me
 * @group information
 */
class InformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_me_information()
    {
        $response = $this->get(route('me.information'));

        $response->assertRedirect('/me/login');
    }

    public function test_authenticated_user_can_view_me_information_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('me.information'));

        $response->assertStatus(200)
            ->assertSee('Types of Testimonies')
            ->assertSee('Public')
            ->assertSee('Private')
            ->assertSee('Published')
            ->assertSee('Draft')
            ->assertSee('How to Write Using Markdown')
            ->assertSee('# My Testimony')
            ->assertSee('God gave me peace and purpose');
    }
}
