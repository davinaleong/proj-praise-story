<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\SpecialContentGroup;
use App\Helpers\Status;

class SpecialContentGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Status::STATUSES_SPECIAL_CONTENT_GROUP as $status) {
            SpecialContentGroup::create([
                'uuid' => Str::uuid(),
                'slug' => Str::slug("group-{$status}"),
                'title' => ucfirst($status) . ' Group',
                'description' => "This is a {$status} group for special content.",
                'status' => $status,
                'sort_order' => rand(1, 100),
            ]);
        }
    }
}
