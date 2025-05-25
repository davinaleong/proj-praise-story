<?php

namespace Tests\Feature\Livewire\Me;

use App\Helpers\Status;
use App\Livewire\Me\PublishedTestimonies\Index;
use App\Models\Testimony;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group livewire
 * @group me
 * @group published-testimony
 */
class PublishedTestimoniesTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_authenticated_users_published_testimonies()
    {
        $user = User::factory()->create();

        // Should be visible
        $visible = Testimony::factory()->count(3)->sequence(
            ['status' => Status::STATUS_TESTIMONY_PUBLIC],
            ['status' => Status::STATUS_TESTIMONY_PRIVATE],
            ['status' => Status::STATUS_TESTIMONY_PUBLISHED],
        )->for($user)->create();

        // Should NOT be visible
        $invisible = Testimony::factory()->count(2)->state([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_DRAFT,
        ])->create();

        Livewire::actingAs($user)
            ->test(Index::class)
            ->assertStatus(200)
            ->assertSee($visible[0]->title)
            ->assertSee($visible[1]->title)
            ->assertSee($visible[2]->title)
            ->assertDontSee($invisible[0]->title)
            ->assertDontSee($invisible[1]->title);
    }

    public function test_guests_cannot_access_component()
    {
        $this->get(route('me.published.index'))
            ->assertRedirect(route('me.login'));
    }
}
