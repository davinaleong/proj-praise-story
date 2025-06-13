<?php

namespace Database\Factories;

use App\Models\SpecialContentItem;
use App\Models\SpecialContentGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Enums\Type;

class SpecialContentItemFactory extends Factory
{
    protected $model = SpecialContentItem::class;

    public function definition(): array
    {
        $title = $this->faker->optional()->sentence(3);

        return [
            'uuid' => Str::uuid(),
            'slug' => Str::slug($title ?: Str::random(8)) . '-' . Str::random(4),
            'group_id' => SpecialContentGroup::factory(),
            'title' => $title,
            'type' => $this->faker->optional()->randomElement(array_column(Type::cases(), 'value')),
            'content' => $this->faker->optional()->paragraph(),
            'media_url' => $this->faker->optional()->imageUrl(),
            'link_url' => $this->faker->optional()->url(),
            'button_text' => $this->faker->optional()->words(2, true),
        ];
    }
}
