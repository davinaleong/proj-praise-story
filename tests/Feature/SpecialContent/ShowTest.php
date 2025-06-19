<?php

namespace Tests\Feature\SpecialContent;

use Tests\TestCase;
use App\Models\User;
use App\Models\SpecialContentGroup;
use App\Models\SpecialContentItem;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\SpecialContent\Show;

/**
 * @group feature
 * @group special-content
 * @group special-content-show
 */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login()
    {
        $group = SpecialContentGroup::factory()->create();

        $this->get(route('special-content.show', ['uuid' => $group->uuid]))
            ->assertRedirect(route('me.login')); // Adjust if you use a custom route
    }

    public function test_authenticated_user_can_view_special_content_group_and_its_items()
    {
        $user = User::factory()->create();
        $group = SpecialContentGroup::factory()->create([
            'title' => 'Christian Growth Series',
        ]);

        $items = SpecialContentItem::factory()->count(3)->create([
            'group_id' => $group->id,
            'title' => 'Day 1: Walking by Faith',
            'content' => 'This is the devotional for day 1.',
            'link_url' => 'https://example.com',
            'button_text' => 'Read More',
        ]);

        $this->actingAs($user);

        Livewire::actingAs($user)
            ->test(Show::class, ['uuid' => $group->uuid])
            ->assertSet('group.title', 'Christian Growth Series')
            ->assertViewHas('items', function ($viewItems) use ($items) {
                return $viewItems->count() === 3;
            })
            ->assertSee('Christian Growth Series')
            ->assertSee('Day 1: Walking by Faith')
            ->assertSee('Read More')
            ->assertSee('https://example.com');
    }

    public function test_component_throws_404_if_group_uuid_is_invalid()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->withoutExceptionHandling();

        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        Livewire::actingAs($user)
            ->test(Show::class, ['uuid' => 'invalid-uuid']);
    }
}
