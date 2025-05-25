<?php

namespace Tests\Feature\Livewire\Me;

use App\Helpers\Status;
use App\Livewire\Me\Dashboard;
use App\Models\Testimony;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group livewire
 * @group me
 * @group dashboard
 */
class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_dashboard()
    {
        $response = $this->get(route('me.dashboard'));
        $response->assertRedirect('/me/login');
    }

    public function test_dashboard_shows_loading_state_before_init()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Dashboard::class)
            ->assertSee('Loading testimonies...')
            ->assertDontSee('Public Testimonies');
    }

    public function test_dashboard_loads_testimonies_and_counts_correctly()
    {
        $user = User::factory()->create();

        Testimony::factory()->create([
            'user_id' => $user->id,
            'title' => 'Public Testimony',
            'status' => Status::STATUS_TESTIMONY_PUBLIC,
        ]);

        Testimony::factory()->create([
            'user_id' => $user->id,
            'title' => 'Private Testimony',
            'status' => Status::STATUS_TESTIMONY_PRIVATE,
        ]);

        Testimony::factory()->create([
            'user_id' => $user->id,
            'title' => 'Published Testimony',
            'status' => Status::STATUS_TESTIMONY_PUBLISHED,
        ]);

        Livewire::actingAs($user)
            ->test(Dashboard::class)
            ->call('loadTestimonies')
            ->assertSet('readyToLoad', true)
            ->assertSee('Public Testimonies')
            ->assertSee('Private Testimonies')
            ->assertSee('Total Published')
            ->assertSee('Public Testimony')
            ->assertSee('Private Testimony')
            ->assertSee('Published Testimony');
    }

    public function test_dashboard_shows_empty_state_when_no_testimonies()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Dashboard::class)
            ->call('loadTestimonies')
            ->assertSee('No testimonies written yet.');
    }
}
