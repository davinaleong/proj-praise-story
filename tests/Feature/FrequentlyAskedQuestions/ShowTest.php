<?php

namespace Tests\Feature\FrequentlyAskedQuestions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group feature
 * @group faq
 * @group faq-show
 */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_faq_page_loads_successfully()
    {
        $response = $this->get('/frequently-asked-questions'); // Adjust the URI to match your route

        $response->assertStatus(200);
        $response->assertSee('Frequently Asked Questions');
        $response->assertSee('What is Praise Story?');
        $response->assertSee('How do I create a testimony?');
        $response->assertSee('Can I contact the team behind Praise Story?');
    }
}
