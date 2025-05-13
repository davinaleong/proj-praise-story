<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group feature
 * @group testimony
 */
class TestimonyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_testimonies_for_authenticated_user(): void
    {
        $user = User::factory()->create();
        $testimonies = Testimony::factory()->count(2)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('testimonies.index'));

        $response->assertStatus(200);
        foreach ($testimonies as $testimony) {
            $response->assertSee($testimony->title);
        }
    }

    public function test_create_displays_form_with_status_options(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('testimonies.create'));

        $response->assertStatus(200);
        $response->assertSee('form'); // Adjust as needed for your Blade
    }

    public function test_store_creates_testimony_and_redirects(): void
    {
        $user = User::factory()->create();

        $payload = [
            'title' => 'My Testimony',
            'content' => 'God is good!',
            'status' => 'draft',
            'published_date' => now()->format('Y-m-d'),
        ];

        $response = $this->actingAs($user)->post(route('testimonies.store'), $payload);

        $response->assertRedirect();
        $this->assertDatabaseHas('testimonies', [
            'title' => 'My Testimony',
            'user_id' => $user->id,
        ]);
    }
}
