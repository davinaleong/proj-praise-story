<?php

namespace Tests\Feature\Admins\SpecialContents\Groups;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\SpecialContentGroup;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\Status;

/**
 * @group feature
 * @group admin
 * @group special-content
 * @group special-content-group
 * @group special-content-group-edit
 */
class EditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_component_mounts_and_pre_fills_fields()
    {
        $admin = Admin::factory()->create();
        $group = SpecialContentGroup::factory()->create([
            'description' => 'Original description',
            'sort_order' => 5,
        ]);

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.groups.edit', ['uuid' => $group->uuid])
            ->assertSet('title', $group->title)
            ->assertSet('slug', $group->slug)
            ->assertSet('description', $group->description)
            ->assertSet('status', $group->status)
            ->assertSet('sort_order', $group->sort_order);
    }

    /** @test */
    public function test_validation_fails_on_missing_required_fields()
    {
        $admin = Admin::factory()->create();
        $group = SpecialContentGroup::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.groups.edit', ['uuid' => $group->uuid])
            ->set('title', '')
            ->set('slug', '')
            ->set('status', '')
            ->call('update')
            ->assertHasErrors(['title', 'slug', 'status']);
    }

    /** @test */
    public function test_group_can_be_updated_successfully()
    {
        $admin = Admin::factory()->create();
        $group = SpecialContentGroup::factory()->create([
            'title' => 'Old Title',
            'slug' => 'old-title',
            'description' => 'Old description',
            'status' => Status::STATUS_SPECIAL_CONTENT_GROUP_DRAFT,
            'sort_order' => 1,
        ]);

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.groups.edit', ['uuid' => $group->uuid])
            ->set('title', 'New Title')
            ->set('slug', 'new-title')
            ->set('description', 'Updated description')
            ->set('status', Status::STATUS_SPECIAL_CONTENT_GROUP_PUBLISHED)
            ->set('sort_order', 10)
            ->call('update')
            ->assertRedirect(route('admins.special-contents.groups.show', ['uuid' => $group->uuid]));

        $this->assertDatabaseHas('special_content_groups', [
            'id' => $group->id,
            'title' => 'New Title',
            'slug' => 'new-title',
            'description' => 'Updated description',
            'status' => Status::STATUS_SPECIAL_CONTENT_GROUP_PUBLISHED,
            'sort_order' => 10,
        ]);
    }
}
