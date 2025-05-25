<?php

namespace Tests\Feature\Livewire;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group livewire
 * @group feedback
 */
class FeedbackFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_feedback_form()
    {
        $response = $this->get(route('me.feedback'));

        $response->assertRedirect('/me/login');
    }

    public function test_authenticated_user_can_render_feedback_form()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('me.feedback'))
            ->assertStatus(200)
            ->assertSee('Feedback')
            ->assertSee('Let us know how we’re doing');
    }

    public function test_honeypot_field_blocks_submission()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(\App\Livewire\Me\FeedbackForm::class)
            ->set('honeypot', 'bot')
            ->set('rating', 5)
            ->set('message', 'Bot attempt')
            ->call('submit');

        $this->assertDatabaseMissing('feedback', [
            'message' => 'Bot attempt',
        ]);
    }

    public function test_rating_is_required_and_between_1_and_5()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(\App\Livewire\Me\FeedbackForm::class)
            ->set('rating', null)
            ->call('submit')
            ->assertHasErrors(['rating' => 'required']);

        Livewire::actingAs($user)
            ->test(\App\Livewire\Me\FeedbackForm::class)
            ->set('rating', 0)
            ->call('submit')
            ->assertHasErrors(['rating' => 'min']);

        Livewire::actingAs($user)
            ->test(\App\Livewire\Me\FeedbackForm::class)
            ->set('rating', 6)
            ->call('submit')
            ->assertHasErrors(['rating' => 'max']);
    }

    public function test_valid_feedback_is_saved_and_message_is_reset()
    {
        $user = User::factory()->create();

        // Livewire::actingAs($user)
        //     ->test(\App\Livewire\Me\FeedbackForm::class)
        //     ->set('rating', 4)
        //     ->set('message', 'I love this app!')
        //     ->call('submit');

        // dd(session('success'));

        Livewire::actingAs($user)
            ->test(\App\Livewire\Me\FeedbackForm::class)
            ->set('rating', 4)
            ->set('message', 'I love this app!')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('message', null)
            ->assertSet('rating', null)
            ->assertSee('Thank you for your feedback!');

        $this->assertDatabaseHas('feedback', [
            'rating' => 4,
            'message' => 'I love this app!',
        ]);
    }
}
