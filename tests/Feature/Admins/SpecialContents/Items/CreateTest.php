<?php

namespace Tests\Feature\Admins\SpecialContents\Items;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\SpecialContentGroup;
use App\Models\SpecialContentItem;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use App\Enums\Type;

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

    public function test_component_mounts_with_group_if_provided()
    {
        $admin = Admin::factory()->create();
        $group = SpecialContentGroup::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.items.create', ['group' => $group])
            ->assertSet('group_id', $group->id);
    }

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

        Livewire::test('admins.special-contents.items.create')
            ->set('group_id', $group->id)
            ->set('slug', 'new-item-slug')
            ->set('title', 'New Item Title')
            ->set('type', Type::Text->value) // assuming TEXT exists in enum
            ->set('content', 'Sample content')
            ->set('media_url', 'https://example.com/media.jpg')
            ->set('link_url', 'https://example.com')
            ->set('button_text', 'Click Me')
            ->set('published_at', now()->format('Y-m-d\TH:i')) // ISO format with 'datetime-local' input
            ->call('save')
            ->assertRedirect(route('admins.special-contents.items.index'));

        $this->assertDatabaseHas('special_content_items', [
            'slug' => 'new-item-slug',
            'title' => 'New Item Title',
            'group_id' => $group->id,
        ]);
    }
}
