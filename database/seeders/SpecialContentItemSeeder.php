<?php

namespace Database\Seeders;

use App\Models\SpecialContentGroup;
use App\Models\SpecialContentItem;
use Illuminate\Database\Seeder;

class SpecialContentItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if there are existing Special Content Groups
        $groups = SpecialContentGroup::all();

        if ($groups->isEmpty()) {
            // No groups exist – create 3 to 5 groups with 3 to 5 items each
            $groupCount = rand(3, 5);
            $groups = SpecialContentGroup::factory()
                ->count($groupCount)
                ->create()
                ->each(function ($group) {
                    $itemsCount = rand(3, 5);
                    SpecialContentItem::factory()
                        ->count($itemsCount)
                        ->for($group)
                        ->create();
                });

            $this->command->info("Created {$groupCount} groups and 3–5 items each.");
        } else {
            // Groups exist – for each, add 3 to 5 new items
            foreach ($groups as $group) {
                $itemsCount = rand(3, 5);
                SpecialContentItem::factory()
                    ->count($itemsCount)
                    ->for($group)
                    ->create();
            }

            $this->command->info("Seeded 3–5 items into each of the existing " . $groups->count() . " groups.");
        }
    }
}
