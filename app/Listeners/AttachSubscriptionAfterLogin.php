<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use App\Models\Subscription;
use App\Helpers\Status;
use Illuminate\Events\Attributes\AsListener;

#[AsListener(event: \Illuminate\Auth\Events\Authenticated::class)]
class AttachSubscriptionAfterLogin
{
    /**
     * Handle the event.
     */
    public function handle(Authenticated $event): void
    {
        $user = $event->user;

        $subscription = Subscription::query()
            ->where('user_id', $user->id)
            ->where('status', Status::STATUS_SUBSCRIPTION_ACTIVE)
            ->latest('started_at')
            ->first();

        if ($subscription) {
            $user->subscription_status = Status::STATUS_SUBSCRIPTION_ACTIVE; // Optional: if you're tracking it on the user model
            $user->save();
        }
    }
}
