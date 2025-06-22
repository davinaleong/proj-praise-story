<?php

namespace Tests\Feature\Admins\Search;

use App\Livewire\Admins\Search\Index;
use App\Models\User;
use App\Models\Testimony;
use App\Models\Contact;
use App\Models\Feedback;
use App\Models\Message;
use App\Models\SpecialContentItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group feature
 * @group admin
 * @group search
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_query_returns_users_and_other_models()
    {
        $user = User::factory()->create(['name' => 'John Searchable']);
        $testimony = Testimony::factory()->create(['title' => 'Searchable Testimony']);
        $contact = Contact::factory()->create(['subject' => 'Searchable Subject']);
        $feedback = Feedback::factory()->create(['message' => 'Searchable Feedback']);
        $message = Message::factory()->create(['body' => 'Searchable Message']);
        $special = SpecialContentItem::factory()->create(['title' => 'Searchable Special']);

        Livewire::test(Index::class)
            ->set('query', 'Searchable')
            ->assertViewHas('users', fn ($users) => $users->contains($user))
            ->assertViewHas('testimonies', fn ($items) => $items->contains($testimony))
            ->assertViewHas('contacts', fn ($items) => $items->contains($contact))
            ->assertViewHas('feedback', fn ($items) => $items->contains($feedback))
            ->assertViewHas('messages', fn ($items) => $items->contains($message))
            ->assertViewHas('specials', fn ($items) => $items->contains($special));
    }

    public function test_no_results_for_short_query()
    {
        User::factory()->create(['name' => 'Short']);

        Livewire::test(Index::class)
            ->set('query', 'S') // too short (1 char)
            ->assertViewHas('users', fn ($users) => $users->isEmpty());
    }
}
