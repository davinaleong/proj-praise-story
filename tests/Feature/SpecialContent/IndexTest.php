<?php

namespace Tests\Feature\SpecialContent;

use App\Helpers\Status;
use Tests\TestCase;
use App\Models\User;
use App\Models\SpecialContentGroup;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\SpecialContent\Index;
use App\Helpers\Setting;

/**
 * @group feature
 * @group special-content
 * @group special-content-index
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_see_special_content_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('special-content.index'))
             ->assertStatus(200);
    }

    public function test_unauthenticated_user_is_redirected_to_login()
    {
        $this->get(route('special-content.index'))
             ->assertRedirect(route('me.login')); // Adjust if using a custom login route
    }

    public function test_component_displays_paginated_groups()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        SpecialContentGroup::factory()->count(Setting::ITEMS_PER_PAGE_100 + 3)->create([
            'status' => Status::STATUS_SPECIAL_CONTENT_GROUP_PUBLIC,
        ]);

        Livewire::actingAs($user)
            ->test(Index::class)
            ->assertViewHas('groups', function ($groups) {
                return $groups->count() === Setting::ITEMS_PER_PAGE_100;
            });
    }

    public function test_component_renders_group_title_and_description()
    {
        $user = User::factory()->create();
        $group = SpecialContentGroup::factory()->create([
            'title' => 'Faith and Growth',
            'description' => 'Grow in your spiritual walk.',
            'status' => Status::STATUS_SPECIAL_CONTENT_GROUP_PUBLIC,
        ]);

        $this->actingAs($user);

        Livewire::actingAs($user)
            ->test(Index::class)
            ->assertSee('Faith and Growth')
            ->assertSee('Grow in your spiritual walk.');
    }
}
