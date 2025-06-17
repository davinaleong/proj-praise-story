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
 * @group special-content-group-index
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an admin and authenticate
        $this->admin = Admin::factory()->create();
        $this->actingAs($this->admin, 'admin');
    }

    public function test_admin_can_see_special_content_groups_index()
    {
        $groups = SpecialContentGroup::factory()->count(3)->create();

        Livewire::test(\App\Livewire\Admins\SpecialContents\Groups\Index::class)
            ->assertStatus(200)
            ->assertSee('Special Content Groups')
            ->assertSee($groups[0]->title)
            ->assertSee($groups[1]->title)
            ->assertSee($groups[2]->title);
    }

    public function test_special_content_groups_index_has_pagination()
    {
        SpecialContentGroup::factory()->count(150)->create(); // Exceeds default page size (100)

        Livewire::test(\App\Livewire\Admins\SpecialContents\Groups\Index::class)
            ->assertStatus(200)
            ->assertSeeHtml('<nav') // Laravel pagination renders <nav>
            ->assertSeeHtml('href'); // Links in pagination
    }
}
