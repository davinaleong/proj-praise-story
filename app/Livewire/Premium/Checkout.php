<?php

namespace App\Livewire\Premium;

use Livewire\Component;

class Checkout extends Component
{
    public bool $paid = false;

    public function pay()
    {
        // Simulate payment success
        $this->paid = true;

        // In production, you'd integrate with Stripe or similar
        session()->flash('message', 'Thank you! Your premium access is now active.');
        return redirect()->route('me.login'); // Redirect to login for Flow B
    }

    public function render()
    {
        return view('livewire.premium.checkout');
    }
}
