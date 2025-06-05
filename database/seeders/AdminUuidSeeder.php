<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Admin;
use RuntimeException;

class AdminUuidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Admin::count() === 0) {
            throw new RuntimeException('No admins found. Please run AdminSeeder before this seeder.');
        }

        $admnins = Admin::all();

        foreach ($admnins as $admin) {
            $admin->uuid = Str::uuid();
            $admin->save();
        }
    }
}
