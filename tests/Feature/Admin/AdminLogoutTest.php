<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * @group feature
 * @group admin
 * @group admin-logout
 */
class AdminLogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_log_out_successfully(): void
    {
        // Arrange: create and log in an admin
        $admin = Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this
            ->actingAs($admin, 'admin')
            ->post(route('admin.logout'));

        // Assert: redirected to admin login
        $response->assertRedirect(route('admin.login'));

        // Assert: admin is no longer authenticated
        $this->assertGuest('admin');
    }

    public function test_guest_cannot_access_logout(): void
    {
        // Try logging out without being logged in
        $response = $this->post(route('admin.logout'));

        // Should redirect to admin login
        $response->assertRedirect(route('me.login'));
    }
}
