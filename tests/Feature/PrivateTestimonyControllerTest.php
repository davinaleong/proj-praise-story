<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Testimony;
use App\Helpers\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group feature
 * @group private
 * @group private-testimony
 */
class PrivateTestimonyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_public_and_private_testimonies()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $public = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);

        $private = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);

        $published = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_PUBLISHED,
        ]);

        $draft = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_DRAFT,
        ]);

        $response = $this->get(route('private-testimonies.index')); // make sure this route exists

        $response->assertOk();
        $response->assertViewHas('testimonies', function ($testimonies) use ($public, $private, $published, $draft) {
            return $testimonies->contains($public)
                && $testimonies->contains($private)
                && !$testimonies->contains($published)
                && !$testimonies->contains($draft);
        });
    }

    public function test_show_displays_testimony_if_user_is_owner()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $testimony = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);

        $response = $this->get(route('private-testimonies.show', ['uuid' => $testimony->uuid]));

        $response->assertOk();
        $response->assertViewHas('testimony', $testimony);
    }

    public function test_show_forbidden_for_other_users()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $this->actingAs($user);

        $testimony = Testimony::factory()->create([
            'user_id' => $otherUser->id,
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);

        $response = $this->get(route('private-testimonies.show', ['uuid' => $testimony->uuid]));

        $response->assertForbidden();
    }

    public function test_show_returns_404_for_nonexistent_testimony()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('private-testimonies.show', ['uuid' => 'non-existent-uuid']));

        $response->assertNotFound();
    }
}
