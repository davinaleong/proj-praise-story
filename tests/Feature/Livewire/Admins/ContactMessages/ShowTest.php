<?php

namespace Tests\Feature\Livewire\Admins\ContactMessages;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group feature
 * @group livewire
 * @group admin
 * @group admin-contact
 * @group admin-contact-show
 */
class ShowTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_admin_can_view_contact_message_show_page()
    {
        // Arrange: Create an admin and a contact message
        $admin = Admin::factory()->create();
        $contact = Contact::factory()->create([
            'email' => 'test@example.com',
            'subject' => 'Test Subject',
            'message' => 'This is a test message.',
        ]);

        // Act & Assert
        $this->actingAs($admin, 'admin')
            ->get(route('admins.contact-messages.show', $contact->uuid))
            ->assertSuccessful()
            ->assertSeeLivewire('admins.contact-messages.show')
            ->assertSeeText('Contact Message')
            ->assertSeeText($contact->email)
            ->assertSeeText($contact->subject)
            ->assertSeeText($contact->message);
    }
}
