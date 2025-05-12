<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Helpers\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimony>
 */
class TestimonyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
    'user_id' => User::factory(),
    'title' => fake()->sentence(),
    'content' => <<<MD
# My Testimony

I want to share what **Jesus** has done in my life.

## A New Beginning

> “Therefore, if anyone is in Christ, he is a new creation...” — 2 Corinthians 5:17

- I was lost but now am found.
- I struggled with fear and doubt.
- But God gave me peace and purpose.

## Conclusion

Thank you, Lord, for Your grace!

*To God be the glory.*
MD,
    'status' => fake()->randomElement(Status::STATUSES_TESTIMONY),
];
    }
}
