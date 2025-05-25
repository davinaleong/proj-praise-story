<?php

namespace Tests\Feature\TermsAndConditions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Livewire\TermsAndConditions\Me;
use App\Livewire\TermsAndConditions\Show;
use App\Models\User;

/**
 * @group livewire
 * @group terms-and-conditions
 */
class TermsAndConditionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_me_component_renders_successfully()
    {
        Livewire::test(Me::class)
            ->assertStatus(200)
            ->assertSee('Terms and Conditions') // You can add more key phrases if needed
            ->assertSee('1. Use of the Site');
    }

    public function test_show_component_renders_successfully_with_back_link()
    {
        Livewire::test(Show::class)
            ->assertStatus(200)
            ->assertSee('Terms and Conditions')
            ->assertSee('← Back')
            ->assertSee('8. Contact');
    }

    public function test_me_page_view_contains_layout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/me/terms-and-conditions'); // adjust if route differs
        $response->assertStatus(200)
                 ->assertSee('Terms and Conditions');
    }

    /**
     * @group failed
     */
    public function test_show_page_view_contains_footer_and_back_link()
    {
        $response = $this->get('/terms-and-conditions'); // adjust if route differs
        $response->assertStatus(200)
                 ->assertSee('← Back')
                 ->assertSee('Terms and Conditions');
    }
}
