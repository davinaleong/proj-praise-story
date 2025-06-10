<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group unit
 * @group model
 * @group testimony
 */
class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_uuid_on_create()
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->uuid);
        $this->assertIsString($user->uuid->toString());
        $this->assertEquals(36, strlen($user->uuid->toString()));
    }

    public function test_user_can_be_found_by_uuid()
    {
        $user = User::factory()->create();

        $found = User::where('uuid', $user->uuid)->first();

        $this->assertNotNull($found);
        $this->assertEquals($user->id, $found->id);
    }

    public function test_has_expected_fillable_attributes(): void
    {
        $user = new User();
        $this->assertEquals(['uuid', 'name', 'email', 'password'], $user->getFillable());
    }

    public function test_hides_sensitive_attributes(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('secret'),
            'remember_token' => 'randomtoken123',
        ]);

        $array = $user->toArray();

        $this->assertArrayNotHasKey('password', $array);
        $this->assertArrayNotHasKey('remember_token', $array);
    }

    public function test_casts_email_verified_at_as_datetime_and_password_is_hashed(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $user->email_verified_at);
        $this->assertNotEquals('secret', $user->password); // Should be hashed
    }

    public function test_initials_returns_correct_value(): void
    {
        $user = new User(['name' => 'Davina Leong']);
        $this->assertEquals('DL', $user->initials());

        $user->name = 'John Q Public';
        $this->assertEquals('JQP', $user->initials());
    }

    public function test_has_many_testimonies(): void
    {
        $user = User::factory()->create();
        $testimonies = Testimony::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->testimonies);
        $this->assertInstanceOf(Testimony::class, $user->testimonies->first());
    }
}
