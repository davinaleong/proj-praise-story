<?php

namespace Tests\Feature\Livewire\Admins\ContactMessages;

use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-contact
 * @group admin-contact-index
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_contact_messages_index()
    {
        $admin = Admin::factory()->create();
        $contact = Contact::factory()->create([
            'email' => 'example@example.com',
            'subject' => 'Test Subject',
        ]);

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.contact-messages.index')
            ->assertStatus(200)
            ->assertSee('Contact Messages')
            ->assertSee($contact->email)
            ->assertSee($contact->subject);
    }

    public function test_contact_message_search_filters_results()
    {
        $admin = Admin::factory()->create();

        $match = Contact::factory()->create(['subject' => 'Important update']);
        $nonMatch = Contact::factory()->create(['subject' => 'Spam mail']);

        $this->actingAs($admin, 'admin');

        Livewire::test('admins.contact-messages.index')
            ->set('search', 'Important')
            ->assertSee('Important update')
            ->assertDontSee('Spam mail');
    }

    public function test_unauthenticated_admin_cannot_access_index()
    {
        $this->get(route('admins.contact-messages.index'))
            ->assertRedirect(route('me.login'));
    }
}
