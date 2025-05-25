<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Contact;
use App\Mail\ContactConfirmation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group livewire
 * @group contact
 */
class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_submits_successfully()
    {
        Mail::fake();

        Livewire::test(Contact::class)
            ->set('email', 'test@example.com')
            ->set('message', 'This is a test message that is long enough.')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('contacts', [
            'email' => 'test@example.com',
            'message' => 'This is a test message that is long enough.',
        ]);

        Mail::assertSent(ContactConfirmation::class, function ($mail) {
            return $mail->hasTo('test@example.com');
        });
    }

    public function test_contact_form_requires_valid_email_and_message()
    {
        Livewire::test(Contact::class)
            ->set('email', '')
            ->set('message', 'short')
            ->call('submit')
            ->assertHasErrors(['email' => 'required', 'message' => 'min']);

        Livewire::test(Contact::class)
            ->set('email', 'not-an-email')
            ->set('message', '')
            ->call('submit')
            ->assertHasErrors(['email' => 'email', 'message' => 'required']);
    }

    public function test_contact_form_rejects_spam_via_honeypot()
    {
        Mail::fake();

        Livewire::test(Contact::class)
            ->set('honeypot', 'bot-filled')
            ->set('email', 'bot@example.com')
            ->set('message', 'Spam message here.')
            ->call('submit');

        $this->assertDatabaseMissing('contacts', [
            'email' => 'bot@example.com',
        ]);

        Mail::assertNothingSent();
    }
}
