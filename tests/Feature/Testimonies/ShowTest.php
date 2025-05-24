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

    public function test_unpublished_testimony_returns_404_response(): void
    {
        $testimony = Testimony::factory()->create([
            'status' => Status::STATUS_TESTIMONY_DRAFT,
        ]);

        $response = $this->get(route('testimonies.public', $testimony->uuid));

        $response->assertNotFound(); // same as assertStatus(404)
    }

}
