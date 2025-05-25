<?php

namespace Tests\Feature\Livewire\Me;

use App\Livewire\Me\Testimonies\Create;
use App\Livewire\Me\Testimonies\Edit;
use App\Livewire\Me\Testimonies\Show;
use App\Models\Testimony;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Helpers\Status;

/**
 * @group livewire
 * @group me
 * @group testimony-crud
 */
class TestimoniesCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_testimony()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Create::class)
            ->set('title', 'My Story')
            ->set('content', 'This is what Jesus did for me.')
            ->set('status', Status::STATUS_TESTIMONY_PUBLIC)
            ->set('published_at', '2025-05-25')
            ->call('submit');

        $this->assertDatabaseHas('testimonies', [
            'user_id' => $user->id,
            'title' => 'My Story',
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);
    }

    public function test_user_can_see_their_testimony_details()
    {
        $user = User::factory()->create();
        $testimony = Testimony::factory()->create([
            'user_id' => $user->id,
            'title' => 'Faith Journey',
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
            'published_at' => now(),
        ]);

        Livewire::actingAs($user)
            ->test(Show::class, ['uuid' => $testimony->uuid])
            ->assertSee('Faith Journey')
            ->assertSee($testimony->getHumanPublishedAt());
    }

    public function test_user_can_update_their_testimony()
    {
        $user = User::factory()->create();
        $testimony = Testimony::factory()->create([
            'user_id' => $user->id,
            'title' => 'Old Title',
            'content' => 'Old content.',
            'status' => Status::STATUS_TESTIMONY_DRAFT,
            'published_at' => now(),
        ]);

        Livewire::actingAs($user)
            ->test(Edit::class, ['uuid' => $testimony->uuid])
            ->set('title', 'Updated Title')
            ->set('content', 'Updated content.')
            ->set('status', Status::STATUS_TESTIMONY_PUBLISHED)
            ->set('published_at', '2025-05-25')
            ->call('update');

        $this->assertDatabaseHas('testimonies', [
            'id' => $testimony->id,
            'title' => 'Updated Title',
            'content' => 'Updated content.',
            'status' => Status::STATUS_TESTIMONY_PUBLISHED,
        ]);
    }

    public function test_user_can_delete_their_testimony()
    {
        $user = User::factory()->create();
        $testimony = Testimony::factory()->create([
            'user_id' => $user->id,
        ]);

        Livewire::actingAs($user)
            ->test(Show::class, ['uuid' => $testimony->uuid])
            ->call('delete');

        $this->assertSoftDeleted('testimonies', [
            'id' => $testimony->id,
        ]);
    }
}
