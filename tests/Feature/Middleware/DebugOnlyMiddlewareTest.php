<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

/**
 * @group feature
 * @group middleware
 * @group debug-only
 */
class DebugOnlyMiddlewareTest extends TestCase
{
    public function test_debug_only_route_allows_access_when_debug_is_true(): void
    {
        Config::set('app.debug', true);

        $response = $this->get('/middleware-test');
        $response->assertStatus(200);
        $response->assertSee('debug route works');
    }

    public function test_debug_only_route_denies_access_when_debug_is_false(): void
    {
        Config::set('app.debug', false);

        $response = $this->get('/middleware-test');
        $response->assertStatus(403);
        $response->assertSee('This route is only available in debug mode.');
    }
}
