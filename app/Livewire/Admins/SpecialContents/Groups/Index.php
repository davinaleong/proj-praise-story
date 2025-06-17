<?php

namespace Tests\Feature\Admins\SpecialContents\Groups;

use App\Livewire\Admins\SpecialContents\Groups\Index;
use App\Models\Admin;
use App\Models\SpecialContentGroup;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_component_renders_for_admin()
    {
        $admin = Admin::factory()->create();
        $groups = SpecialContentGroup::factory()->count(3)->create();

        $this->actingAs($admin, 'admin');

        Livewire::test(Index::class)
            ->assertStatus(200)
            ->assertViewHas('groups', function ($viewGroups) use ($groups) {
                return $viewGroups->count() === $groups->count();
            });
    }

    public function test_index_requires_admin_authentication()
    {
        $this->get(route('admins.special-contents.groups.index'))
            ->assertRedirect(route('me.login'));
    }
}
