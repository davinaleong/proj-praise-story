<?php

namespace App\Livewire\Me\Testimonies;

use Livewire\Component;
use App\Models\Testimony;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    public Testimony $testimony;

    public string $from = 'testimonies';

    public function mount(string $uuid, string $from = 'testimonies'): void
    {
        $this->testimony = Testimony::with('user')
            ->with('likes')
            ->where('uuid', $uuid)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    }

    public function delete()
    {
        $this->testimony->delete();

        session()->flash('success', 'Testimony deleted successfully.');

        return redirect()->route('me.testimonies.index');
    }

    public function render()
    {
        return view('livewire.me.testimonies.show')
            ->layout('components.layouts.me', [
                'title' => $this->testimony->title
            ]);
    }
}
