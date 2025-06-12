<?php

namespace Tests\Feature\Livewire\Admins\FeedbackMessages;

use App\Models\Admin;
use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-feedback
 * @group admin-feedback-index
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_feedback_messages_index_page()
    {
        $admin = Admin::factory()->create();
        $feedback = Feedback::factory()->create([
            'message' => 'Great app!',
            'rating' => 5,
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admins.feedback-messages.index'))
            ->assertStatus(200)
            ->assertSee('Feedback Messages')
            ->assertSee('Great app!');
    }

    public function test_admin_can_search_feedback_by_message()
    {
        $admin = Admin::factory()->create();

        Feedback::factory()->create(['message' => 'Easy to use']);
        Feedback::factory()->create(['message' => 'Hard to navigate']);

        Livewire::actingAs($admin, 'admin')
            ->test('admins.feedback-messages.index')
            ->set('search', 'Easy')
            ->assertSee('Easy to use')
            ->assertDontSee('Hard to navigate');
    }

    public function test_guest_cannot_access_feedback_index()
    {
        $this->get(route('admins.feedback-messages.index'))
            ->assertRedirect(route('me.login'));
    }
}
