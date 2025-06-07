<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Message;
use App\Models\Testimony;
use App\Models\Contact;
use App\Models\Feedback;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = Admin::all();
        $users = User::all();

        if ($admins->isEmpty()) {
            throw new \RuntimeException('No admin records found in `admins` table.');
        }

        if ($users->isEmpty()) {
            throw new \RuntimeException('No user records found in `users` table.');
        }

        $testimonies = Testimony::all();
        $contacts = Contact::all();
        $feedbacks = Feedback::all();

        $contexts = collect()
            ->merge($users)
            ->merge($testimonies)
            ->merge($contacts)
            ->merge($feedbacks)
            ->shuffle();

        for ($i = 0; $i < 20; $i++) {
            $admin = $admins->random();
            $user = $users->random();

            $message = Message::factory()
                ->for($user, 'user')
                ->unsent()
                ->make([
                    'admin_id' => $admin->id,
                ]);

            // Attach optional context (50% chance)
            if ($contexts->isNotEmpty() && rand(0, 1)) {
                $context = $contexts->random();
                $message->context_type = get_class($context);
                $message->context_id = $context->getKey();
            }

            $message->save();
        }
    }
}
