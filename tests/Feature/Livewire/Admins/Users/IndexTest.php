<?php

namespace Tests\Feature\Livewire\Admins\Users;

use App\Livewire\Admins\Users\Index;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group admin
 * @group user
 * @group user-index
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_displays_users_list(): void
    {
        $users = User::factory()->count(3)->create();

        Livewire::test(Index::class)
            ->assertStatus(200)
            ->assertSee('Users')
            ->assertSee($users[0]->name)
            ->assertSee($users[1]->email);
    }
}
