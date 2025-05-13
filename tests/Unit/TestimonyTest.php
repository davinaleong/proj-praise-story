<?php

namespace Tests\Unit;

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

    /**
     * @group status
     */
    public function test_get_human_status_returns_human_readable_status()
    {
        // Arrange
        $statusCode = 'draft';
        $expectedHumanName = 'Draft';

        $testimony = new Testimony([
            'status' => $statusCode,
        ]);

        // Mock the Status::getHumanName() static method
        $statusMock = Mockery::mock('alias:' . Status::class);
        $statusMock->shouldReceive('getHumanName')
            ->once()
            ->with($statusCode)
            ->andReturn($expectedHumanName);

        // Act
        $result = $testimony->getHumanStatus();

        // Assert
        $this->assertEquals($expectedHumanName, $result);
    }

    /**
     * @group published-date
     */
    public function test_get_human_published_date_returns_formatted_date()
    {
        // Arrange
        $formattedDate = '13 May 2025';
        $rawDate = '2025-05-13';

        // Create a Testimony instance with the given published_date
        $testimony = new Testimony([
            'published_date' => $rawDate,
        ]);

        // Mock the DateFormatter::toDisplay() static call
        $formatterMock = Mockery::mock('alias:' . DateFormatter::class);
        $formatterMock->shouldReceive('toDisplay')
            ->once()
            ->with($rawDate)
            ->andReturn($formattedDate);

        // Act
        $result = $testimony->getHumanPublishedDate();

        // Assert
        $this->assertEquals($formattedDate, $result);
    }
}
