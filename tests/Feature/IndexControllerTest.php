<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\Status;
use App\Helpers\Setting;

/**
 * @group feature
 * @group index
 */
class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_public_testimonies()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        // Public testimony (should be shown)
        $public = Testimony::factory()->create([
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);

        // Private testimony (should not be shown)
        $private = Testimony::factory()->create([
            'status' => 'private',
        ]);

        // Act
        $response = $this->get(route('index'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('index.index');
        $response->assertViewHas('testimonies', function ($testimonies) use ($public, $private) {
            return $testimonies->contains($public) && !$testimonies->contains($private);
        });
    }

    public function test_show_displays_authorized_testimony()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        $testimony = Testimony::factory()->create([
            'uuid' => 'test-uuid',
            'user_id' => $user->id,
        ]);

        // Act
        $response = $this->get(route('testimonies.public', $testimony->uuid));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('index.show');
        $response->assertViewHas('testimony', $testimony);
    }

    public function test_show_blocks_unauthorized_user()
    {
        // Arrange
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $this->actingAs($otherUser);

        $testimony = Testimony::factory()->create([
            'uuid' => 'unauthorized-uuid',
            'user_id' => $owner->id,
        ]);

        // Act
        $response = $this->get(route('testimonies.public', $testimony->uuid));

        // Assert
        $response->assertForbidden();
    }
}
