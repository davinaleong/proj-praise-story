<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'uuid' => (string) Str::uuid(),
            'subject' => $this->faker->sentence,
            'body' => $this->faker->paragraphs(3, true),

            // Optional morph context (null by default)
            'context_type' => null,
            'context_id' => null,

            'user_id' => User::factory(),
            'admin_id' => Admin::factory(),

            'sent_at' => now(),
        ];
    }

    /**
     * Attach the message to a specific context model.
     */
    public function withContext(Model $context): static
    {
        return $this->state(fn () => [
            'context_type' => $context::class,
            'context_id' => $context->getKey(),
        ]);
    }

    /**
     * Mark the message as unsent.
     */
    public function unsent(): static
    {
        return $this->state([
            'sent_at' => null,
        ]);
    }
}
