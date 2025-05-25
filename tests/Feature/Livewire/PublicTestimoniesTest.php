<?php

namespace Tests\Feature\Livewire;

use App\Helpers\Status;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group livewire
 * @group testimonies
 * @group public
 */
class PublicTestimoniesTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_only_public_testimonies()
    {
        $public = Testimony::factory()->create([
            'title' => 'Visible to All',
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);

        $draft = Testimony::factory()->create([
            'title' => 'Hidden Draft',
            'status' => Status::STATUS_TESTIMONY_DRAFT,
        ]);

        $private = Testimony::factory()->create([
            'title' => 'Hidden Private',
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200)
                 ->assertSee('Visible to All')
                 ->assertDontSee('Hidden Draft')
                 ->assertDontSee('Hidden Private');
    }

    public function test_user_can_view_public_testimony_details()
    {
        $public = Testimony::factory()->create([
            'title' => 'Open Testimony',
            'content' => 'Praise the Lord!',
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);

        $response = $this->get(route('testimonies.public', $public->uuid));

        $response->assertStatus(200)
                 ->assertSee('Open Testimony')
                 ->assertSee('Praise the Lord!');
    }

    public function test_accessing_non_public_testimony_returns_404()
    {
        $draft = Testimony::factory()->create([
            'status' => Status::STATUS_TESTIMONY_DRAFT,
        ]);

        $response = $this->get(route('testimonies.public', $draft->uuid));
        $response->assertStatus(404);

        $private = Testimony::factory()->create([
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);

        $response = $this->get(route('testimonies.public', $private->uuid));
        $response->assertStatus(404);
    }
}
