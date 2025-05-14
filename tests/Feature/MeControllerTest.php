<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\Status;

/**
 * @group feature
 * @group me
 */
class MeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_only_authenticated_users_public_and_private_testimonies()
    {
        // Arrange
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $this->actingAs($user);

        // Testimonies belonging to the authenticated user
        $public = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);
        $private = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);
        $draft = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => 'draft',
        ]);

        // Testimony from another user (should not appear)
        $otherUserTestimony = Testimony::factory()->create([
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);

        // Act
        $response = $this->
            get(route('me.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('me.index');
        $response->assertViewHas('testimonies', function ($testimonies) use ($public, $private, $draft, $otherUserTestimony) {
            return
                $testimonies->contains($public) &&
                $testimonies->contains($private) &&
                !$testimonies->contains($draft) &&
                !$testimonies->contains($otherUserTestimony);
        });
    }

    public function test_show_displays_own_private_or_public_testimony()
    {
        // Arrange
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $this->actingAs($user);

        $testimony = Testimony::factory()->create([
            'user_id' => $user->id,
            'uuid' => 'user-testimony-uuid',
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);

        // Act
        $response = $this->get(route('me.show', $testimony->uuid));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('me.show');
        $response->assertViewHas('testimony', $testimony);
    }

    public function test_show_denies_access_to_others_testimony_even_if_public_or_private()
    {
        // Arrange
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $otherUser = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $this->actingAs($user);

        $otherTestimony = Testimony::factory()->create([
            'user_id' => $otherUser->id,
            'uuid' => 'other-testimony-uuid',
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);

        // Act
        $response = $this->get(route('me.show', $otherTestimony->uuid));

        // Assert
        $response->assertForbidden();
    }
}
