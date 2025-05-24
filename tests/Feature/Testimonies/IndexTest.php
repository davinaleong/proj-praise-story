<?php

namespace Tests\Feature\Livewire\Testimonies;

use App\Livewire\Testimonies\Index;
use App\Models\Testimony;
use App\Models\User;
use App\Helpers\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group livewire
 * @group testimonies
 * @group public
 * @group index
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_renders(): void
    {
        Livewire::test(Index::class)
            ->assertStatus(200);
    }

    public function test_component_shows_public_testimonies(): void
    {
        $user = User::factory()->create();
        $public = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
            'title' => 'God is Good',
        ]);

        $draft = Testimony::factory()->create([
            'user_id' => $user->id,
            'status' => Status::STATUS_TESTIMONY_DRAFT,
            'title' => 'Hidden One',
        ]);

        Livewire::test(Index::class)
            ->assertSee('God is Good')
            ->assertDontSee('Hidden One');
    }
}

