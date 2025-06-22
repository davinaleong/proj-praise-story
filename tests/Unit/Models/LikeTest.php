<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Like;
use App\Models\Testimony;
use App\Enums\LikeType;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group unit
 * @group model
 * @group like
 */
class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_like_can_be_created_for_a_testimony()
    {
        $like = Like::factory()->create([
            'type' => LikeType::Green->value,
        ]);

        $this->assertDatabaseHas('likes', [
            'testimony_id' => $like->testimony_id,
            'type' => LikeType::Green->value,
        ]);
    }

    public function test_like_type_must_be_valid()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Like::create([
            'testimony_id' => Testimony::factory()->create(),
            'type' => 'blue', // Invalid value
        ]);
    }

    public function test_a_testimony_can_have_multiple_likes()
    {
        $testimony = Testimony::factory()->create();

        Like::factory()->count(3)->create([
            'testimony_id' => $testimony->id,
        ]);

        $this->assertCount(3, $testimony->likes);
    }
}
