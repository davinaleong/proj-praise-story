<?php

namespace Tests\Unit\Models;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @group unit
 * @group model
 * @group admin
 */
class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_has_uuid_on_create()
    {
        $admin = Admin::factory()->create();

        $this->assertNotNull($admin->uuid);
        $this->assertIsString($admin->uuid->toString());
        $this->assertEquals(36, strlen($admin->uuid->toString()));
    }

    public function test_admin_can_be_found_by_uuid()
    {
        $admin = Admin::factory()->create();

        $found = Admin::where('uuid', $admin->uuid)->first();

        $this->assertNotNull($found);
        $this->assertEquals($admin->id, $found->id);
    }

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

    public function test_it_returns_initials_from_full_name(): void
    {
        $admin = new Admin(['name' => 'Davina Leong']);
        $this->assertEquals('DL', $admin->initials);
    }

    public function test_it_returns_initials_from_single_name(): void
    {
        $admin = new Admin(['name' => 'Davina']);
        $this->assertEquals('D', $admin->initials);
    }

    public function test_it_ignores_extra_spaces(): void
    {
        $admin = new Admin(['name' => '  Davina   Leong  Tan  ']);
        $this->assertEquals('DLT', $admin->initials);
    }

    public function test_it_handles_unicode_names(): void
    {
        $admin = new Admin(['name' => '李 小龙']);
        $this->assertEquals('李小', $admin->initials); // Assumes each character is a word
    }

}
