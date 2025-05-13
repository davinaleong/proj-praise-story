<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Testimony;

class TestimonySeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            $count = rand(1, 10);

            Testimony::factory()
                ->count($count)
                ->for($user)
                ->create();
        });
    }
}
