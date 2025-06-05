<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use RuntimeException;

class UserUuidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() === 0) {
            throw new RuntimeException('No users found. Please run UserSeeder before this seeder.');
        }

        $users = User::all();

        foreach ($users as $user) {
            $user->uuid = Str::uuid();
            $user->save();
        }
    }
}
