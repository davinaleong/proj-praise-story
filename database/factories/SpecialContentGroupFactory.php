<?php

namespace Database\Factories;

use App\Models\SpecialContentGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Helpers\Status;

class SpecialContentGroupFactory extends Factory
{
    protected $model = SpecialContentGroup::class;

    public function definition(): array
    {
        $title = $this->faker->words(3, true);

        return [
            'uuid' => Str::uuid(),
            'slug' => Str::slug($title) . '-' . Str::random(4),
            'title' => $title,
            'description' => $this->faker->optional()->paragraph(),
            'status' => $this->faker->randomElement(Status::STATUSES_SPECIAL_CONTENT_GROUP),
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }
}

