<?php

namespace Tests\Feature\Admins\SpecialContents\Items;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Admin;
use App\Models\SpecialContentItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group feature
 * @group admin
 * @group special-content
 * @group special-content-item
 * @group special-content-item-show
 */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_renders_with_given_item()
    {
        $admin = Admin::factory()->create();
        $item = SpecialContentItem::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.items.show', ['uuid' => $item->uuid])
            ->assertStatus(200)
            ->assertSet('item.slug', $item->slug)
            ->assertSee($item->title);
    }

    public function test_delete_function_soft_deletes_item_and_redirects()
    {
        $admin = Admin::factory()->create();
        $item = SpecialContentItem::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.items.show', ['uuid' => $item->uuid])
            ->call('delete')
            ->assertRedirect(route('admins.special-contents.items.index'));

        $this->assertSoftDeleted($item);
    }
}
