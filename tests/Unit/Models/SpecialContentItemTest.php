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
 * @group special-content-item
 */
class SpecialContentItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_an_item_with_valid_attributes(): void
    {
        $item = SpecialContentItem::factory()->create();

        $this->assertNotNull($item->uuid);
        $this->assertNotNull($item->slug);
        $this->assertDatabaseHas('special_content_items', [
            'id' => $item->id,
            'slug' => $item->slug,
        ]);
    }

    public function test_it_belongs_to_a_group(): void
    {
        $group = SpecialContentGroup::factory()->create();
        $item = SpecialContentItem::factory()->create(['group_id' => $group->id]);

        $this->assertTrue($item->specialContentGroup->is($group));
    }
}
