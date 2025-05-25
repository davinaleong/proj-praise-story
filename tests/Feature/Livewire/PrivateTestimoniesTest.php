<?php

namespace Tests\Feature\Livewire;

use App\Helpers\Status;
use App\Models\Testimony;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group livewire
 * @group testimonies
 * @group private
 */
class PrivateTestimoniesTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_see_private_testimonies_index()
    {
        $user = User::factory()->create();

        $private = Testimony::factory()->create([
            'title' => 'Private One',
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);

        $public = Testimony::factory()->create([
            'title' => 'Public One',
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);

        $this->actingAs($user)
            ->get(route('private.testimonies.index'))
            ->assertStatus(200)
            ->assertSee('Private One')
            ->assertSee('Public One');
    }

    public function test_guest_cannot_access_private_testimonies_index()
    {
        $response = $this->get(route('private.testimonies.index'));

        $response->assertRedirect('/me/login');
    }

    /**
     * @group failed
     */
    public function test_authenticated_user_can_view_private_testimony_details()
    {
        $user = User::factory()->create();

        $private = Testimony::factory()->create([
            'title' => 'Secret Testimony',
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
            'content' => 'This is confidential.',
        ]);

        $this->actingAs($user)
            ->get(route('private.testimonies.show', ['uuid' => $private->uuid]))
            ->assertStatus(200)
            ->assertSee('Secret Testimony')
            ->assertSee('This is confidential.');
    }

    public function test_guest_cannot_view_private_testimony()
    {
        $private = Testimony::factory()->create([
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);

        $this->get(route('private.testimonies.show', ['uuid' => $private->uuid]))
            ->assertRedirect('me/login');
    }

    public function test_unpublished_testimony_returns_404()
    {
        $user = User::factory()->create();

        $draft = Testimony::factory()->create([
            'status' => Status::STATUS_TESTIMONY_DRAFT,
        ]);

        $this->actingAs($user)
            ->get(route('private.testimonies.show', ['uuid' => $draft->uuid]))
            ->assertStatus(404);
    }
}
