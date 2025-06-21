<?php

namespace Tests\Feature\Admins\SpecialContents\Items;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Admin;
use App\Models\SpecialContentGroup;
use App\Models\SpecialContentItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\ItemType;

/**
 * @group feature
 * @group admin
 * @group special-content
 * @group special-content-item
 * @group special-content-item-edit
 */
class EditTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_mounts_with_existing_item_data()
    {
        $admin = Admin::factory()->create();
        $group = SpecialContentGroup::factory()->create();
        $item = SpecialContentItem::factory()->create([
            'group_id' => $group->id,
        ]);

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.items.edit', ['uuid' => $item->uuid])
            ->assertSet('group_id', $item->group_id)
            ->assertSet('title', $item->title)
            ->assertSet('type', $item->type)
            ->assertSet('content', $item->content)
            ->assertSet('media_url', $item->media_url)
            ->assertSet('link_url', $item->link_url)
            ->assertSet('button_text', $item->button_text);
    }

    public function test_update_updates_the_item_and_redirects()
    {
        $admin = Admin::factory()->create();
        $group = SpecialContentGroup::factory()->create();
        $item = SpecialContentItem::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.items.edit', ['uuid' => $item->uuid])
            ->set('group_id', $group->id)
            ->set('title', 'Updated Title')
            ->set('type', ItemType::Text->value)
            ->set('content', 'Updated content')
            ->set('media_url', 'https://example.com/media.jpg')
            ->set('link_url', 'https://example.com/link')
            ->set('button_text', 'Read More')
            ->set('published_at', now()->format('Y-m-d\TH:i'))
            ->call('update')
            ->assertRedirect(route('admins.special-contents.items.show', ['uuid' => $item->uuid]));

        $this->assertDatabaseHas('special_content_items', [
            'id' => $item->id,
            'title' => 'Updated Title',
            'type' => ItemType::Text->value,
        ]);
    }

    public function test_validation_fails_for_invalid_inputs()
    {
        $admin = Admin::factory()->create();
        $item = SpecialContentItem::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.items.edit', ['uuid' => $item->uuid])
            ->set('group_id', null) // required
            ->set('media_url', 'not-a-url') // invalid
            ->call('update')
            ->assertHasErrors(['group_id' => 'required', 'media_url' => 'url']);
    }
}
