<?php

namespace Tests\Unit\Traits;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use App\Models\Testimony;
use App\Models\User;

/**
 * @group unit
 * @group trait
 * @group has-uuid
 */
class HasUuidTest extends TestCase
{
    use RefreshDatabase;

    public function test_uuid_is_generated_when_creating_model()
    {
        $user = User::factory()->create();
        $model = Testimony::create([
            'user_id' => $user->id
        ]);

        $this->assertNotNull($model->uuid);
        $this->assertTrue(Str::isUuid($model->uuid));
    }

    public function test_existing_uuid_is_preserved()
    {
        $user = User::factory()->create();
        $customUuid = (string) Str::uuid();

        $model = Testimony::create([
            'uuid' => $customUuid,
            'user_id' => $user->id,
        ]);

        $this->assertEquals($customUuid, $model->uuid);
    }
}
