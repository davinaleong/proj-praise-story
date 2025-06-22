<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Testimony;
use App\Enums\LikeType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Like>
 */
class LikeFactory extends Factory
{
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'testimony_id' => Testimony::factory(),
            'type' => fake()->randomElement([
                LikeType::Green->value,
                LikeType::Yellow->value,
                LikeType::Red->value,
            ]),
            // 'testimony_id' should be set via relationship or state
        ];
    }
}
