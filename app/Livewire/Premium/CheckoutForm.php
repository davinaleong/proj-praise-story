<?php

namespace App\Livewire\Premium;

use Livewire\Component;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutForm extends Component
{
    public function pay()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'sgd',
                    'product_data' => [
                        'name' => 'Premium Testimony Access',
                    ],
                    'unit_amount' => 1000, // S$10.00
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'metadata' => [
                'user_id' => auth()->id(),
            ],
            'success_url' => route('premium.testimonies.index') . '?success=true',
            'cancel_url' => route('home') . '?cancel=true',
        ]);

        return redirect()->away($session->url);
    }

    public function render()
    {
        return view('livewire.premium.checkout-form')
            ->layout('components.layouts.auth');
    }
}
