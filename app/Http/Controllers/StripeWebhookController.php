<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Helpers\Status;
use Stripe\Webhook;
use Stripe\Stripe;

class StripeWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                config('services.stripe.webhook_secret')
            );
        } catch (\Exception $e) {
            return response('Webhook error: ' . $e->getMessage(), 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            // Get user ID from metadata
            $userId = $session->metadata->user_id ?? null;
            $user = User::find($userId);

            if ($user) {
                $user->subscription()->updateOrCreate(
                    [],
                    [
                        'status' => Status::STATUS_SUBSCRIPTION_ACTIVE,
                        'stripe_subscription_id' => $session->id,
                        'started_at' => now(),
                        'ended_at' => null,
                    ]
                );
            }
        }

        return response('Webhook handled', 200);
    }
}
