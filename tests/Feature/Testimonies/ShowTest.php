<?php

namespace Tests\Feature\Livewire\Testimonies;

use App\Livewire\Testimonies\Show;
use App\Models\Testimony;
use App\Helpers\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

/**
 * @group livewire
 * @group testimonies
 * @group public
 * @group show
 */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_renders_single_testimony(): void
    {
        $testimony = Testimony::factory()->create([
            'title' => 'Healing Miracle',
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);

        Livewire::test(Show::class, ['uuid' => $testimony->uuid])
            ->assertStatus(200)
            ->assertSee('Healing Miracle');
    }

    public function test_component_returns_404_for_unpublished_testimony(): void
    {
        $testimony = Testimony::factory()->create([
            'title' => 'Hidden One',
            'status' => Status::STATUS_TESTIMONY_DRAFT,
        ]);

        $this->expectException(NotFoundHttpException::class);

        Livewire::test(Show::class, ['uuid' => $testimony->uuid]);
    }

}
