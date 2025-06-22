<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimony;
use App\Models\Like;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonies = Testimony::all();

        if ($testimonies->isEmpty()) {
            throw new \Exception('No testimonies found. Seed testimonies before running LikeSeeder.');
        }

        $this->command->info("Seeding likes for {$testimonies->count()} testimonies...");

        DB::transaction(function () use ($testimonies) {
            $testimonies->each(function (Testimony $testimony) {
                $likeCount = fake()->numberBetween(3, 15); // Adjust range as needed

                Like::factory()
                    ->count($likeCount)
                    ->create([
                        'testimony_id' => $testimony->id,
                    ]);
            });
        });

        $this->command->info('Likes seeded successfully.');
    }
}
