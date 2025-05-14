<?php

namespace Tests\Feature\Me;

use Tests\TestCase;
use App\Models\User;
use App\Models\Testimony;
use App\Helpers\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group feature
 * @group me
 * @group me-testimony
 */
class TestimonyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_only_authenticated_users_non_draft_testimonies()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Belongs to user and not draft
        $public = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);

        // Belongs to user but is draft
        $draft = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_DRAFT,
        ]);

        // Belongs to another user but not draft
        $otherUser = User::factory()->create();
        $others = Testimony::factory()->create([
            'user_id' => $otherUser->id,
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);

        $response = $this->get(route('me.testimonies.index'));

        $response->assertOk();
        $response->assertViewHas('testimonies', function ($testimonies) use ($public, $draft, $others) {
            return $testimonies->contains($public)
                && !$testimonies->contains($draft)
                && !$testimonies->contains($others);
        });
    }

    public function test_show_displays_testimony_if_user_is_owner_and_not_draft()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $testimony = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);

        $response = $this->get(route('me.testimonies.show', ['uuid' => $testimony->uuid]));

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

        $response = $this->get(route('me.testimonies.show', ['uuid' => $testimony->uuid]));

        $response->assertForbidden();
    }

    public function test_show_returns_404_for_draft_status()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $testimony = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_DRAFT,
        ]);

        $response = $this->get(route('me.testimonies.show', ['uuid' => $testimony->uuid]));

        $response->assertNotFound();
    }

    public function test_show_returns_404_for_invalid_uuid()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('me.testimonies.show', ['uuid' => 'invalid-uuid']));

        $response->assertNotFound();
    }
}
