<?php

namespace App\Livewire\Me\Settings;

use Livewire\Component;

class Subscription extends Component
{
    public $subscription;

    public function mount()
    {
        $this->subscription = auth()->user()->subscription;
    }

    public function startSubscription()
    {
        $user = auth()->user();

        $subscription = $user->subscription()->updateOrCreate(
            [],
            [
                'status' => 'active',
                'started_at' => now(),
                'ended_at' => null,
            ]
        );

        $this->subscription = $subscription;
    }

    public function stopSubscription()
    {
        if ($this->subscription) {
            $this->subscription->update([
                'status' => 'inactive',
                'ended_at' => now(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.me.settings.subscription')
            ->layout('components.layouts.me', ['title' => 'Subscriptions']);
    }
}

