<?php

namespace Tests\Unit\Models;

use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @group unit
 * @group model
 * @group feedback
 */
class FeedbackTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_feedback_record()
    {
        $feedback = Feedback::factory()->create([
            'rating' => 4,
            'message' => 'Very insightful testimony!',
        ]);

        $this->assertDatabaseHas('feedback', [
            'id' => $feedback->id,
            'rating' => 4,
            'message' => 'Very insightful testimony!',
        ]);

        $this->assertTrue(Str::isUuid($feedback->uuid));
    }

    public function test_it_soft_deletes_feedback()
    {
        $feedback = Feedback::factory()->create();

        $feedback->delete();

        $this->assertSoftDeleted('feedback', [
            'id' => $feedback->id,
        ]);
    }

    public function test_rating_is_cast_as_integer()
    {
        $feedback = Feedback::factory()->create([
            'rating' => '5', // passed as string
        ]);

        $this->assertIsInt($feedback->rating);
        $this->assertSame(5, $feedback->rating);
    }

    public function test_message_can_be_nullable()
    {
        $feedback = Feedback::factory()->create([
            'message' => null,
        ]);

        $this->assertNull($feedback->message);
    }
}
