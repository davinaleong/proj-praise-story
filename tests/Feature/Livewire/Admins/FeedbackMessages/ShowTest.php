<?php

namespace Tests\Feature\Livewire\Admins\FeedbackMessages;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-feedback
 * @group admin-feedback-show
 */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_feedback_message_details(): void
    {
        // Arrange: Create a fake admin and feedback message
        $admin = Admin::factory()->create();
        $feedback = Feedback::factory()->create();

        // Act: Act as admin and visit the feedback message show page
        $response = $this->actingAs($admin, 'admin')
            ->get(route('admins.feedback-messages.show', $feedback->uuid));

        // Assert: Check page load and content
        $response->assertOk();
        $response->assertSeeText('Feedback Message');
        $response->assertSeeText((string) $feedback->rating);
        $response->assertSeeText($feedback->message);
        $response->assertSee($feedback->created_at->format('d-m-Y H:i'));
    }
}
