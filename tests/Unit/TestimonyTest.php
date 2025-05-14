<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Helpers\DateFormatter;
use App\Helpers\Status;

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

    public function test_get_human_status_returns_human_readable_status()
    {
        // Arrange
        $testimony = new Testimony([
            'status' => 'draft',
        ]);

        // Act
        $result = $testimony->getHumanStatus();

        // Assert
        $this->assertEquals('Draft', $result); // Assumes 'draft' maps to 'Draft'
    }

    public function test_get_human_published_date_returns_formatted_value()
    {
        // Arrange
        $testimony = new Testimony([
            'published_at' => '2025-05-13',
        ]);

        // Act
        $result = $testimony->getHumanPublishedDate();

        // Assert
        $this->assertEquals('Tue, 13 May 2025', $result); // Based on DateFormatter::FORMAT_DISPLAY
    }

    public function test_get_input_published_at_returns_formatted_date()
    {
        // Arrange
        $testimony = new Testimony([
            'published_at' => '2025-05-14',
        ]);

        // Act
        $result = $testimony->getInputPublishedAt();

        // Assert
        $this->assertEquals('2025-05-14', $result); // HTML date input format
    }

    public function test_get_input_published_at_returns_empty_string_when_null()
    {
        // Arrange
        $testimony = new Testimony([
            'published_at' => null,
        ]);

        // Act
        $result = $testimony->getInputPublishedAt();

        // Assert
        $this->assertSame('', $result);
    }
}
