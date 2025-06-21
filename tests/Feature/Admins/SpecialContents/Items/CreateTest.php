<?php

namespace Tests\Feature\Admins\SpecialContents\Items;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\SpecialContentGroup;
use App\Models\SpecialContentItem;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use App\Enums\ItemType;
use App\Livewire\Admins\SpecialContents\Items\Create;

/**
 * @group feature
 * @group admin
 * @group special-content
 * @group special-content-item
 * @group special-content-item-create
 */
class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_validation_fails_if_required_fields_are_missing()
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.items.create')
            ->call('save')
            ->assertHasErrors(['group_id', 'slug']);
    }

    public function test_item_is_created_successfully()
    {
        $admin = Admin::factory()->create();
        $group = SpecialContentGroup::factory()->create();

        $this->actingAs($admin, 'admin');

        $slug = 'new-item-slug';

        $component = Livewire::test(Create::class)
            ->set('group_id', $group->id)
            ->set('slug', $slug)
            ->set('title', 'New Item Title')
            ->set('type', ItemType::Text->value)
            ->set('content', 'Sample content')
            ->set('media_url', 'https://example.com/media.jpg')
            ->set('link_url', 'https://example.com')
            ->set('button_text', 'Click Me')
            ->set('published_at', now()->format('Y-m-d\TH:i')) // datetime-local
            ->call('save')
            ->assertSessionHas('success', 'Special content item created successfully.');

        $this->assertDatabaseHas('special_content_items', [
            'slug' => $slug,
            'title' => 'New Item Title',
            'group_id' => $group->id,
        ]);

        $item = SpecialContentItem::where('slug', $slug)->firstOrFail();

        $component->assertRedirect(route('admins.special-contents.items.show', ['uuid' => $item->uuid]));
    }

}
