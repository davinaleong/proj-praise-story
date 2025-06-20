<?php

namespace Tests\Feature\Admins\SpecialContents\Groups;

use Tests\TestCase;
use App\Models\Admin;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Models\SpecialContentGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\Admins\SpecialContents\Groups\Create;
use App\Helpers\Status;

/**
 * @group feature
 * @group admin
 * @group special-content
 * @group special-content-group
 * @group special-content-group-create
 */
class CreateTest extends TestCase
{
    use RefreshDatabase;

    protected Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();
        $this->actingAs($this->admin, 'admin');
    }

    public function test_create_component_can_render()
    {
        Livewire::test(Create::class)
            ->assertStatus(200)
            ->assertSee('Create Special Content Group');
    }

    public function test_title_sets_slug_automatically()
    {
        Livewire::test(Create::class)
            ->set('title', 'My Special Group')
            ->assertSet('slug', 'my-special-group');
    }

    public function test_validation_fails_with_missing_required_fields()
    {
        Livewire::test(Create::class)
            ->set('title', '')
            ->set('slug', '')
            ->set('sort_order', null)
            ->call('save')
            ->assertHasErrors([
                'title',
                'slug',
            ]);
    }

    public function test_admin_can_create_special_content_group()
    {
        $data = [
            'title' => 'New Group',
            'description' => 'Test description',
            'status' => Status::STATUS_SPECIAL_CONTENT_GROUP_DRAFT,
            'sort_order' => 1,
        ];

        $response = Livewire::test(Create::class)
            ->set('title', $data['title']) // triggers slug update
            ->set('description', $data['description'])
            ->set('status', $data['status'])
            ->set('sort_order', $data['sort_order'])
            ->call('save')
            ->assertSessionHas('success', 'Special Content Group created successfully.');

        $group = SpecialContentGroup::where('title', $data['title'])->first();
        $this->assertNotNull($group);

        // Check database entry
        $this->assertDatabaseHas('special_content_groups', [
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'description' => $data['description'],
            'status' => $data['status'],
            'sort_order' => $data['sort_order'],
        ]);

        // ✅ Assert redirect here
        $response->assertRedirect(route('admins.special-contents.groups.show', ['uuid' => $group->uuid]));
    }

}
