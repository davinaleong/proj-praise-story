<?php

namespace Tests\Feature\Admins;

use App\Livewire\Admins\Auth\Login;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group feature
 * @group admin
 * @group admin-login
 */
class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_log_in_with_valid_credentials(): void
    {
        $admin = Admin::create([
            'name' => 'Davina Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
        ]);

        Livewire::test(Login::class)
            ->set('email', 'admin@example.com')
            ->set('password', 'secret123')
            ->call('login')
            ->assertRedirect(route('admins.dashboard'));

        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_login_fails_with_invalid_credentials(): void
    {
        Admin::create([
            'name' => 'Davina Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
        ]);

        Livewire::test(Login::class)
            ->set('email', 'admin@example.com')
            ->set('password', 'wrong-password')
            ->call('login')
            ->assertHasErrors(['email']);

        $this->assertGuest('admin');
    }

    public function test_validation_errors_are_triggered(): void
    {
        Livewire::test(Login::class)
            ->set('email', '') // Empty
            ->set('password', '') // Empty
            ->call('login')
            ->assertHasErrors(['email' => 'required', 'password' => 'required']);

        $this->assertGuest('admin');
    }
}
