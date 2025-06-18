<?php

namespace Tests\Feature\Admins\SpecialContents\Groups;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\SpecialContentGroup;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group feature
 * @group admin
 * @group special-content
 * @group special-content-group
 * @group special-content-group-show
 */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_mounts_and_renders_successfully()
    {
        $admin = Admin::factory()->create();
        $group = SpecialContentGroup::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.groups.show', ['uuid' => $group->uuid])
            ->assertStatus(200)
            ->assertSee($group->title)
            ->assertSee($group->slug)
            ->assertSee($group->description ?? '—')
            ->assertSee($group->status)
            ->assertSee((string) $group->sort_order);
    }

    public function test_component_handles_delete_action_and_redirects()
    {
        $admin = Admin::factory()->create();
        $group = SpecialContentGroup::factory()->create();

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.special-contents.groups.show', ['uuid' => $group->uuid])
            ->call('delete')
            ->assertRedirect(route('admins.special-contents.groups.index'));

        $this->assertSoftDeleted('special_content_groups', ['id' => $group->id]);
    }
}
