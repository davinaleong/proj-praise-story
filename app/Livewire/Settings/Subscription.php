<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription as SubscriptionModel;

class Subscription extends Component
{
    public $user;
    public $subscription;

    public function mount()
    {
        $this->user = auth()->user();
        $this->subscription = $this->user->subscription; // via relationship
    }

    public function subscribe()
    {
        return redirect()->route('premium.checkout'); // or trigger Stripe checkout
    }

    public function render()
    {
        return view('livewire.settings.subscription')
            ->layout('components.layouts.me', ['title' => 'Subscription']);
    }
}
