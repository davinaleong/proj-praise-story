<?php

namespace Tests\Unit\Models;

use App\Models\SpecialContentGroup;
use App\Models\SpecialContentItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group unit
 * @group model
 * @group special-content
 * @group special-content-group
 */
class SpecialContentGroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_group_with_valid_attributes(): void
    {
        $group = SpecialContentGroup::factory()->create();

        $this->assertNotNull($group->uuid);
        $this->assertNotNull($group->slug);
        $this->assertDatabaseHas('special_content_groups', [
            'id' => $group->id,
            'slug' => $group->slug,
        ]);
    }

    public function test_it_has_items_relationship(): void
    {
        $group = SpecialContentGroup::factory()
            ->hasItems(3)
            ->create();

        $this->assertCount(3, $group->items);
        $this->assertInstanceOf(SpecialContentItem::class, $group->items->first());
    }
}
