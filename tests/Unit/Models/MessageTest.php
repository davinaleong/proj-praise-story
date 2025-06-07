<?php

namespace Tests\Unit\Models;

use App\Models\Message;
use App\Models\Admin;
use App\Models\User;
use App\Models\Testimony;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group unit
 * @group model
 * @group message
 */
class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_generates_a_uuid_when_created(): void
    {
        $message = Message::factory()->create();

        $this->assertNotNull($message->uuid);
        $this->assertMatchesRegularExpression(
            '/^[0-9a-fA-F-]{36}$/',
            $message->uuid
        );
    }

    public function test_it_belongs_to_a_user(): void
    {
        $message = Message::factory()->create();

        $this->assertInstanceOf(User::class, $message->user);
    }

    public function test_it_can_have_an_admin(): void
    {
        $message = Message::factory()->create();

        $this->assertInstanceOf(Admin::class, $message->admin);
    }

    public function test_it_can_be_associated_with_a_polymorphic_context(): void
    {
        $testimony = Testimony::factory()->create();
        $message = Message::factory()->withContext($testimony)->create();

        $this->assertTrue($message->context->is($testimony));
        $this->assertEquals(Testimony::class, $message->context_type);
    }

    public function test_it_can_be_soft_deleted(): void
    {
        $message = Message::factory()->create();
        $message->delete();

        $this->assertSoftDeleted($message);
    }
}
