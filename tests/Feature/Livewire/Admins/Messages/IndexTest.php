<?php

namespace Tests\Feature\Livewire\Admins\Messages;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-message
 * @group admin-message-index
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_messages_index_page(): void
    {
        // Create admin and user
        $admin = Admin::factory()->create();
        $user = User::factory()->create();

        // Create message
        Message::factory()->create([
            'user_id' => $user->id,
            'admin_id' => $admin->id,
            'subject' => 'Test Subject',
            'sent_at' => now(),
        ]);

        // Act as admin
        $response = $this->actingAs($admin, 'admin')
            ->get(route('admins.messages.index'));

        // Assert page loads
        $response->assertOk();
        $response->assertSee('Messages');
        $response->assertSee('Test Subject');
    }

    public function test_guests_cannot_access_messages_index_page(): void
    {
        $response = $this->get(route('admins.messages.index'));

        $response->assertRedirect(route('me.login'));
    }
}
