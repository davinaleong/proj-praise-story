<?php

namespace Tests\Feature\Livewire\Admins\Messages;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Message;
use Livewire\Livewire;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminsMessagesMail;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-message
 * @group admin-message-create
 */
class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_create_message_component()
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin')
            ->get(route('admins.messages.create'))
            ->assertOk()
            ->assertSeeLivewire('admins.messages.create');
    }

    public function test_admin_can_create_a_message()
    {
        Mail::fake();

        $admin = Admin::factory()->create();
        $user = User::factory()->create();

        Livewire::actingAs($admin, 'admin')
            ->test('admins.messages.create')
            ->set('subject', 'Test Subject')
            ->set('body', 'This is a test message body.')
            ->set('user_uuid', $user->uuid)
            ->set('context_type', 'App\Models\Testimony')
            ->call('createMessage')
            ->assertRedirect(route('admins.messages.show', Message::first()->uuid));

        $this->assertDatabaseHas('messages', [
            'subject' => 'Test Subject',
            'body' => 'This is a test message body.',
            'user_id' => $user->id,
            'admin_id' => $admin->id,
        ]);

        Mail::assertSent(AdminsMessagesMail::class);
    }

    public function test_subject_and_body_are_required()
    {
        $admin = Admin::factory()->create();
        $user = User::factory()->create();

        Livewire::actingAs($admin, 'admin')
            ->test('admins.messages.create')
            ->set('user_uuid', $user->uuid)
            ->call('createMessage')
            ->assertHasErrors(['subject', 'body']);
    }
}
