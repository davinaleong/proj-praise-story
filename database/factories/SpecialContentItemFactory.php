<?php

namespace Database\Factories;

use App\Models\SpecialContentItem;
use App\Models\SpecialContentGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Enums\ItemType;

class SpecialContentItemFactory extends Factory
{
    protected $model = SpecialContentItem::class;

    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'uuid' => Str::uuid(),
            'slug' => Str::slug($title ?: Str::random(8)) . '-' . Str::random(4),
            'group_id' => SpecialContentGroup::factory(),
            'title' => $title,
            'type' => fake()->randomElement(array_column(ItemType::cases(), 'value')),
            'content' => fake()->paragraph(),
            'media_url' => fake()->imageUrl(),
            'link_url' => fake()->url(),
            'button_text' => fake()->words(2, true),
        ];
    }
}
