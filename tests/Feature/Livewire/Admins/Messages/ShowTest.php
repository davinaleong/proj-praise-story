<?php

namespace Tests\Feature\Livewire\Admins\Messages;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-message
 * @group admin-message-show
 */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_message_show_page()
    {
        // Arrange
        $admin = Admin::factory()->create();
        $user = User::factory()->create();

        $message = Message::factory()->create([
            'uuid' => (string) \Str::uuid(),
            'user_id' => $user->id,
            'admin_id' => $admin->id,
            'subject' => 'Test Subject',
            'body' => 'Test Body',
        ]);

        // Act & Assert
        $this->actingAs($admin, 'admin')
            ->get(route('admins.messages.show', $message->uuid))
            ->assertOk()
            ->assertSee('Message Details')
            ->assertSee($message->subject)
            ->assertSee($message->body)
            ->assertSee($user->name)
            ->assertSee($admin->name);
    }
}
