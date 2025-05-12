<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group unit
 * @group testimony
 */
class TestimonyTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_testimony_with_factory(): void
    {
        $testimony = Testimony::factory()->create();

        $this->assertDatabaseHas('testimonies', [
            'id' => $testimony->id,
            'content' => $testimony->content,
        ]);
    }

    /**
     * @group user
     */
    public function test_it_has_a_user_relationship(): void
    {
        $user = User::factory()->create();
        $testimony = Testimony::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $testimony->user);
        $this->assertEquals($user->id, $testimony->user->id);
    }
}
