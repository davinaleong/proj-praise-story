<?php

namespace Tests\Unit\Models;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group unit
 * @group model
 * @group contact
 */
class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_expected_fillable_fields()
    {
        $contact = new Contact();

        $this->assertEquals([
            'uuid',
            'subject',
            'email',
            'message',
        ], $contact->getFillable());
    }

    public function test_it_uses_uuid_and_is_not_incrementing()
    {
        $contact = new Contact();
        $this->assertFalse($contact->getIncrementing());
        $this->assertEquals('string', $contact->getKeyType());
    }

    public function test_it_creates_contact_using_factory()
    {
        $contact = Contact::factory()->create();

        $this->assertDatabaseHas('contacts', [
            'uuid' => $contact->uuid,
        ]);

        $this->assertNotEmpty($contact->email);
        $this->assertNotEmpty($contact->message);
    }

}
