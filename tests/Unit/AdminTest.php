<?php

namespace Tests\Unit;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @group admin
 */
class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_fill_name_email_and_password(): void
    {
        $admin = Admin::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
        ]);

        $this->assertEquals('Test Admin', $admin->name);
        $this->assertEquals('admin@example.com', $admin->email);
        $this->assertNotNull($admin->password);
    }

    public function test_it_uses_id_as_auth_identifier_name(): void
    {
        $admin = Admin::factory()->create();

        $this->assertEquals('id', $admin->getAuthIdentifierName());
    }

}
