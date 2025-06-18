<?php

namespace Tests\Feature\Admins\SpecialContents\Items;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\SpecialContentGroup;
use App\Models\SpecialContentItem;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group feature
 * @group admin
 * @group special-content
 * @group special-content-item
 * @group special-content-item-index
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_component_renders_with_paginated_items_and_group_titles()
    {
        $admin = Admin::factory()->create();
        $group = SpecialContentGroup::factory()->create(['title' => 'Test Group']);

        $item = SpecialContentItem::factory()->create([
            'group_id' => $group->id,
            'title' => 'Sample Item',
            'slug' => 'sample-item',
            'type' => 'text',
        ]);

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.items.index')
            ->assertStatus(200)
            ->assertSee('Special Content Items')
            ->assertSee('Sample Item')
            ->assertSee('sample-item')
            ->assertSee('text')
            ->assertSee('Test Group');
    }

    /** @test */
    public function test_component_renders_empty_state_when_no_items_exist()
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.items.index')
            ->assertSee('No special content items found.');
    }
}
